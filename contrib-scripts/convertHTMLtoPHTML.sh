while true
do
	for file in /src/app/View/*.html; do
    		sudo mv "$file" "$(basename "$file" .html).phtml"
		echo "$file converted!"
	done
done
