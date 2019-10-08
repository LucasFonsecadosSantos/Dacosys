/**
 * +----------------------------------------------------------------+
 * |                             DACOSYS                            |
 * +----------------------------------------------------------------+
 *
 * DEVELOPED BY:
 * Lucas Fonseca dos Santos - github.com/LucasFonsecaDosSantos
 * Marco Aurelio Ferreira de Sousa - github.com/maureliofs
 * Lucas Fiorini Braga - github.com/ ...
 *
 * License: GNU/GPL - General Public License - V3
 *
 * Latest Update: 08/15/2019
 *
 * The Dacosys database modeling structure.
 * <a brief>
 */
CREATE SCHEMA IF NOT EXISTS `dacosys` DEFAULT CHARACTER SET utf8 ;
USE `dacosys` ;





/**
 * +----------------------------------------------------------------+
 * | CREATING ALL DATABASE TABLES                                   +
 * +----------------------------------------------------------------+
 *
 * - Person
 * - Person Telephone
 * - Person Disease
 * - Quiz
 * - Researcher ACCESS Quiz
 * - Item
 * - item_picture
 * - Item HAS Picture
 * - Participant ANSWER Quiz
 * - Participant ANSWER Item
 */
CREATE TABLE IF NOT EXISTS `dacosys`.`person` (
    `id_person`                 INT(2)      NOT NULL AUTO_INCREMENT,
    `type`                      ENUM('_ADMINISTRATOR_','_RESEARCHER_','_PARTICIPANT_') NOT NULL,
    `name`                      TEXT,
    `email`                     VARCHAR(40) NOT NULL,
    `password`                  CHAR(72) NOT NULL,
    `sex`                       ENUM('_M_','_F_','_O_'),
    `hometown_cep`              CHAR(8),
    `color`         ENUM('_BRANCO_','_PARDO_','_NEGRO_','_INDIGENA_'),
    `birth_day`                 DATE,
    `latest_access`             DATE,
    `latest_ip_access`          VARCHAR(12),
    `supervisor_idPerson`       INT(2),
    PRIMARY KEY(`id_person`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`telephone` (
    `person_idPerson`   INT(2)      NOT NULL,
    `telephone`         VARCHAR(13) NOT NULL,
    PRIMARY KEY(`person_idPerson`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`disease` (
    `participant_idPerson`  INT(2)  NOT NULL,
    `disease`               TEXT    NOT NULL,
    PRIMARY KEY(`person_idPerson`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`quiz` (
    `id_quiz`           INT(2) NOT NULL,
    `creator_idPerson`  INT(2) NOT NULL
    PRIMARY KEY(`id_quiz`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`reseacher_access_quiz` (
    `reseacher_idPerson`    INT(2)  NOT NULL,
    `quiz_idQuiz`           INT(2)  NOT NULL,
    PRIMARY KEY(`researcher_idPerson`,`quiz_idQuiz`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`item` (
    `id_item`           INT(2) NOT NULL,
    `has_description`   TINYINT NOT NULL,
    `answer_type`       ENUM(`_DISCREET_`,`_CONTINUOUS_`)
    PRIMARY KEY(`id_item`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`item_picture` (
    `id_picture`    INT(4)  NOT NULL,
    `title`         VARCHAR(50),
    `path`          TEXT    NOT NULL,
    PRIMARY KEY(`id_picture`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`item_has_picture` (
    `item_picture_idPicture`    INT(4)  NOT NULL,
    `item_idItem`               INT(2)  NOT NULL,
    PRIMARY KEY(`item_picture_idPicture`,`item_idItem`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`participant_answer_quiz` (
    `participant_idPerson`  INT(2) NOT NULL,
    `quiz_idQuiz`           INT(2) NOT NULL
    PRIMARY KEY(`person_idPerson`,`quiz_idQuiz`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`participant_answer_item` (
    `participant_idPerson`  INT(2)  NOT NULL,
    `item_idItem`           INT(2)  NOT NULL,
    `quiz_idQuiz`           INT(2)  NOT NULL,
    PRIMARY KEY(`participant_idPerson`,`item_idItem`,`quiz_idQuiz`)
)ENGINE = InnoDB;




/**
 * +----------------------------------------------------------------+
 * | CREATING THE UNIQUE KEYS                                       +
 * +----------------------------------------------------------------+
 */
CREATE UNIQUE INDEX `uk_person_email` ON `dacosys`.`person` (`email` ASC)




/**
 * +----------------------------------------------------------------+
 * | CREATING ALL TABLE CONSTRAINTS                                 +
 * +----------------------------------------------------------------+
 */
 ALTER TABLE `person`
    ADD CONSTRAINT fk_person_supervisor
    FOREIGN KEY (`supervisor_idPerson`)
    REFERENCES `person` (`id_person`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `telephone`
    ADD CONSTRAINT fk_person_person
    FOREIGN KEY (`person_idPerson`)
    REFERENCES `person` (`id_person`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `disease`
    ADD CONSTRAINT fk_person_participant
    FOREIGN KEY (`participant_idPerson`)
    REFERENCES `person` (`id_person`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `quiz`
    ADD CONSTRAINT fk_person_creator
    FOREIGN KEY (`creator_idPerson`)
    REFERENCES `person` (`id_person`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `reseacher_access_quiz`
    ADD CONSTRAINT fk_person_researcher
    FOREIGN KEY (`reseacher_idPerson`)
    REFERENCES `person` (`id_person`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `item_has_picture`
    ADD CONSTRAINT fk_item_item
    FOREIGN KEY (`item_idItem`)
    REFERENCES `person` (`id_person`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `item_has_picture`
    ADD CONSTRAINT fk_picture_picture
    FOREIGN KEY (`item_picture_idPicture`)
    REFERENCES `item_picture` (`id_picture`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;