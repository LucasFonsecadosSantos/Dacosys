#!/usr/bin/env bash
######################################################

declare -A osInfo;
osInfo[/etc/redhat-release]=yum
osInfo[/etc/arch-release]=pacman
osInfo[/etc/gentoo-release]=emerge
osInfo[/etc/SuSE-release]=zypp
osInfo[/etc/debian_version]=apt-get
HOST_FILE=/etc/hosts
SERVICE="php"

if pgrep -x "$SERVICE" > /dev/null; then
	echo [..] "$SERVICE" is runing
	echo [..] Finalizing "$SERVICE" service
	killall -9 "$SERVICE"
else
	echo [OK] "$SERVICE" is stop
fi

if [ -f "$HOST_FILE" ]; then
	echo "$HOST_FILE" exists.
else
	echo [..] Creating "$HOST_FILE" config
	cp -avr installation/hosts /etc/hosts
fi

for f in ${!osInfo[@]}
do
    if [[ -f $f ]]; then
        echo Package manager: ${osInfo[$f]}
        if ! [ -x "$(command -v mariadb)" ]; then
        else
            echo '[ERROR] You do not have PHP package installed.'
            if [ $f == "/etc/arch-release" ]; then
                echo '[..] THE MARIADB INSTALLATION PROCESS WILL BE STARTED'
                sudo pacman -Sy mariadb
                echo '[OK] PHP PACKAGE DEPENDENCIE HAS BEEN INSTALLED'
            elif [ $f == "/etc/redhat-release" ]; then
                echo '[..] THE PHP INSTALLATION PROCESS WILL BE STARTED'
                sudo yum update
                sudo yum install mariadb-server
                echo '[OK] PHP PACKAGE DEPENDENCIE HAS BEEN INSTALLED'
            elif [ $f == "/etc/gentoo-release" ]; then
                echo '[..] THE MARIADB INSTALLATION PROCESS WILL BE STARTED'
                sudo emerge --sync
                sudo emerge --update world
                sudo emerge --ask dev-db/mariadb
                echo '[OK] MARIADB PACKAGE DEPENDENCIE HAS BEEN INSTALLED'
            elif [ $f == "/etc/SuSE-release" ]; then
                echo '[..] THE MARIADB INSTALLATION PROCESS WILL BE STARTED'
                sudo sudo zypper install php7 php7-mysql
                echo '[OK] MARIADB PACKAGE DEPENDENCIE HAS BEEN INSTALLED'
            elif [ $f == "/etc/debian-release" ]; then
                echo '[..] THE MARIADB INSTALLATION PROCESS WILL BE STARTED'
                sudo apt update && apt upgrade
                sudo apt install mariadb-server
                echo '[OK] MARIADB PACKAGE DEPENDENCIE HAS BEEN INSTALLED'
            fi
        fi
        if ! [ -x "$(command -v php)" ]; then
            echo '[ERROR] You do not have PHP package installed.'
            if [ $f == "/etc/arch-release" ]; then
                echo '[..] THE PHP INSTALLATION PROCESS WILL BE STARTED'
                sudo pacman -Sy php
                echo '[OK] PHP PACKAGE DEPENDENCIE HAS BEEN INSTALLED'
            elif [ $f == "/etc/redhat-release" ]; then
                echo '[..] THE PHP INSTALLATION PROCESS WILL BE STARTED'
                sudo yum update
                sudo yum install php php-mcrypt php-cli php-gd php-curl php-mysql php-ldap php-zip php-fileinfo
                echo '[OK] PHP PACKAGE DEPENDENCIE HAS BEEN INSTALLED'
            elif [ $f == "/etc/gentoo-release" ]; then
                echo '[..] THE PHP INSTALLATION PROCESS WILL BE STARTED'
                sudo emerge --sync
                sudo emerge --update world
                sudo emerge --ask dev-lang/php:7.1
                echo '[OK] PHP PACKAGE DEPENDENCIE HAS BEEN INSTALLED'
            elif [ $f == "/etc/SuSE-release" ]; then
                echo '[..] THE PHP INSTALLATION PROCESS WILL BE STARTED'
                sudo sudo zypper install php7 php7-mysql
                echo '[OK] PHP PACKAGE DEPENDENCIE HAS BEEN INSTALLED'
            elif [ $f == "/etc/debian-release" ]; then
                echo '[..] THE PHP INSTALLATION PROCESS WILL BE STARTED'
                sudo apt update && apt upgrade
                sudo apt install apt-transport-https lsb-release ca-certificates
                sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
                sudo echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list
                sudo apt update
                sudo apt install php7.2
                echo '[OK] PHP PACKAGE DEPENDENCIE HAS BEEN INSTALLED'
            fi
        else
            echo '[OK] PHP checked.'
            echo '[OK] NOW, WE CAN LAUNCH THE ACTE'
            sudo php -S 0.0.0.0:8080 &>/dev/null
            sudo systemctl enable mariadb
            sudo systemctl start mariadb
            mysql -u root -p < ./../src/storage/database/dacosys_dbv1.sql
        fi
    fi
done