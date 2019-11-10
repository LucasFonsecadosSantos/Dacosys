USE dacosys

#selecionar senha de usuario com determinado email
SELECT password FROM person WHERE email = "email@email.com";

#selecionar pessoa com a chave passada, para responder o questionario
SELECT access_key FROM person WHERE access_key = "202cb962ac59075b964b07152d234b70";


#selecionar todas as respostas de um quiz
SELECT answer FROM quiz JOIN item ON quiz.id_quiz = item.quiz_idQuiz; 



