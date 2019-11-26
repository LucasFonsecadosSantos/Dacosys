cp -avr ./../frontend/ext/css/* ./../src/public/ext/css
cp -avr ./../frontend/ext/js/* ./../src/public/ext/js

# SYSTEM
cp -avr ./../frontend/about.html ./../src/app/Views/home/about.phtml
cp -avr ./../frontend/accesskey.html ./../src/app/Views/home/accesskey.phtml
cp -avr ./../frontend/bug-report.html ./../src/app/Views/home/bug-report.phtml
cp -avr ./../frontend/dashboard.html ./../src/app/Views/home/index.phtml
cp -avr ./../frontend/login.html ./../src/app/Views/home/login.phtml

# ITEM
cp -avr ./../frontend/item-register.html ./../src/app/Views/item/register.phtml
cp -avr ./../frontend/item-show.html ./../src/app/Views/item/show.phtml

# PARTICIPANT
cp -avr ./../frontend/participant-listation.html ./../src/app/Views/participant/listation.phtml
cp -avr ./../frontend/person.html ./../src/app/Views/participant/show.phtml
cp -avr ./../frontend/participant-login.html ./../src/app/Views/participant/login.phtml
cp -avr ./../frontend/participant-register.html ./../src/app/Views/participant/register.phtml

# QUIZ
cp -avr ./../frontend/quiz.html ./../src/app/Views/quiz/show.phtml
cp -avr ./../frontend/quiz-listation.html ./../src/app/Views/quiz/listation.phtml
cp -avr ./../frontend/quiz-register.html ./../src/app/Views/quiz/register.phtml
cp -avr ./../frontend/quiz-answer.html ./../src/app/Views/quiz/quiz-answer.phtml

# RESEARCHER
cp -avr ./../frontend/researcher-listation.html ./../src/app/Views/researcher/listation.phtml
cp -avr ./../frontend/researcher-register.html ./../src/app/Views/researcher/register.phtml
