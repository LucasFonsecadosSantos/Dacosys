echo "Copying and update extension files..."
mv ./../front-end-src/*.html ./../src/app/Views/*.phtml
echo "HTML files copied from front-end-src/ to app/Views/ and updated to phtml."
cp -avr ./../front-end-src/ext/ ./../front-end-src/img/ ./../src/public/
echo "Resources directories copied to src/public."
