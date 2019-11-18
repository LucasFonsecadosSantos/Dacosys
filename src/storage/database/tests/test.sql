/*-------------------------Person------------------*/
USE dacosys;
INSERT INTO person (
    id_person,
    type,
    name,
    email,
    password,
    participated,
    sex,
    hometown_cep,
    color,
    birth_day,
    latest_access,
    latest_ip_access,
    supervisor_idPerson
) VALUES (
    'person_5dd2aaab4f856',
    '_ADMINISTRATOR_',
    'Nome1',
    'email1@email.com',
    '123456',
    1,
    '_M_',
    '37200000',
    '_BRANCA_',
    '1996-01-20',
    '2019-06-08',
    '192168200123',
    NULL
);

INSERT INTO person (
    id_person,
    type,
    name,
    email,
    password,
    participated,
    sex,
    hometown_cep,
    color,
    birth_day,
    latest_access,
    latest_ip_access,
    supervisor_idPerson
) VALUES (
    'person_5dd2abff62d27',
    '_RESEARCHER_',
    'Nome2',
    'email2@email.com',
    '5495959',
    0,
    '_F_',
    '37200000',
    '_PRETA_',
    '1993-12-05',
    '2018-09-12',
    '192168200111',
    NULL
);
INSERT INTO person (
    id_person,
    type,
    name,
    email,
    password,
    participated,
    sex,
    hometown_cep,
    color,
    birth_day,
    latest_access,
    latest_ip_access,
    supervisor_idPerson    
) VALUES (
    'person_5dd2ac1255e21',
    '_PARTICIPANT_',
    'Nome3',
    'email3@email.com',
    '632512',
    0,
    '_M_',
    '37200000',
    '_PARDA_',
    '1986-01-07',
    '2017-10-05',
    '192168145200',
    NULL
);
INSERT INTO person (
    id_person,
    type,
    name,
    email,
    password,
    participated,
    sex,
    hometown_cep,
    color,
    birth_day,
    latest_access,
    latest_ip_access,
    supervisor_idPerson
) VALUES (
    'person_5dd2ac1aefcf4',
    '_RESEARCHER_',
    'Nome4',
    'email4@email.com',
    '632514124',
    1,
    '_F_',
    '37200000',
    '_BRANCA_',
    '1994-10-20',
    '2019-11-09',
    '192168142122',
    NULL
);
INSERT INTO person (
    id_person,
    type,
    name,
    email,
    password,
    participated,
    sex,
    hometown_cep,
    color,
    birth_day,
    latest_access,
    latest_ip_access,
    supervisor_idPerson  
) VALUES (
    'person_5dd2ac3bb8ee0',
    '_ADMINISTRATOR_',
    'Nome5',
    'email5@email.com',
    'erer854re',
    0,
    '_M_',
    '37201966',
    '_AMARELA_',
    '1997-07-30',
    '2019-08-15',
    '177105023122',
    NULL
);
INSERT INTO person (
    id_person,
    type,
    name,
    email,
    password,
    participated,
    sex,
    hometown_cep,
    color,
    birth_day,
    latest_access,
    latest_ip_access,
    supervisor_idPerson    
) VALUES (
    'person_5dd2ac4490291',
    '_PARTICIPANT_',
    'Nome6',
    'email6@email.com',
    'rge5er5ege5',
    0,
    '_F_',
    '37201214',
    '_INDIGENA_',
    '1991-04-06',
    '2019-07-14',
    '172172012142',
    NULL
);


/*------------------------telefone-------------------------*/
INSERT INTO telephone (
    person_idPerson,
    telephone
) VALUES (
    'person_5dd2aaab4f856',
    '99999999999'
);

INSERT INTO telephone (
    person_idPerson,
    telephone
) VALUES (
    'person_5dd2aaab4f856',
    '88888888888'
);

INSERT INTO telephone (
    person_idPerson,
    telephone
) VALUES (
    'person_5dd2ac4490291',
    '35998652563'
);

/*------------------necessidade especial-----------------*/
INSERT INTO special_needs (
    participant_idPerson,
    need
) VALUES (
    'person_5dd2aaab4f856',
    'cego'
);

/*---------------------------quiz------------------------*/
INSERT INTO quiz (
    id_quiz,
    name,
    start_date,
    end_date,
    status
) VALUES (
    'quiz_5dd2aec419004',
    'Questionario teste 01',
    '20190302',
    '20190320',
    1
);

INSERT INTO quiz (
    id_quiz,
    name,
    start_date,
    end_date,
    status
) VALUES (
    'quiz_5dd2af3e62fe3',
    'Questionario teste 02',
    '20190418',
    '20190501',
    0
);

INSERT INTO quiz (
    id_quiz,
    name,
    start_date,
    end_date,
    status
) VALUES (
    'quiz_5dd2af58cb953',
    'Questionario teste 03',
    '20190618',
    '20190710',
    1
);

INSERT INTO quiz (
    id_quiz,
    name,
    start_date,
    end_date,
    status
) VALUES (
    'quiz_5dd2af771e5f5',
    'Questionario teste 04',
    '20190120',
    '20190120',
    0
);

INSERT INTO quiz (
    id_quiz,
    name,
    start_date,
    end_date,
    status
) VALUES (
    'quiz_5dd2af8fe6957',
    'Questionario teste 05',
    '20190210',
    '20190213',
    1
);

/*---------------reseacher_access_quiz------------------*/
INSERT INTO reseacher_access_quiz (
    reseacher_idPerson,
    quiz_idQuiz
) VALUES (
    'person_5dd2abff62d27',
    'quiz_5dd2aec419004'
);

INSERT INTO reseacher_access_quiz (
    reseacher_idPerson,
    quiz_idQuiz
) VALUES (
    'person_5dd2ac1aefcf4',
    'quiz_5dd2af3e62fe3'
);

INSERT INTO reseacher_access_quiz (
    reseacher_idPerson,
    quiz_idQuiz
) VALUES (
    'person_5dd2ac1aefcf4',
    'quiz_5dd2aec419004'
);
INSERT INTO reseacher_access_quiz (
    reseacher_idPerson,
    quiz_idQuiz
) VALUES (
    'person_5dd2abff62d27',
    'quiz_5dd2af3e62fe3'
);

/*----------------------------item----------------------*/
INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    'item_5dd2b12f5a712',
    'descricao vai aqui',
    'quiz_5dd2aec419004',
    '_DISCREET_',
    4
);

INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    'item_5dd2b15e23431',
    'descricao2 vai aqui',
    'quiz_5dd2aec419004',
    '_CONTINUOUS_',
    NULL
);

INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    'item_5dd2b1796b524',
    'descricao3 vai aqui',
    'quiz_5dd2af3e62fe3',
    '_DISCREET_',
    5
);

INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    'item_5dd2b18e3904e',
    'descricao4 vai aqui',
    'quiz_5dd2af3e62fe3',
    '_CONTINUOUS_',
    NULL
);

INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    'item_5dd2b1a1eaf5b',
    'descricao5 vai aqui',
    'quiz_5dd2af58cb953',
    '_DISCREET_',
    3
);

INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    'item_5dd2b41265a42',
    'descricao6 vai aqui',
    'quiz_5dd2af58cb953',
    '_DISCREET_',
    3
);

INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    'item_5dd2b43fb2e26',
    'descricao7 vai aqui',
    'quiz_5dd2af771e5f5',
    '_DISCREET_',
    4
);

INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    'item_5dd2b444e19f6',
    'descricao8 vai aqui',
    'quiz_5dd2af771e5f5',
    '_CONTINUOUS_',
    NULL
);

INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    'item_5dd2b4680ceec',
    'descricao9 vai aqui',
    'quiz_5dd2af8fe6957',
    '_DISCREET_',
    5
);

INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    'item_5dd2b46ca9213',
    'descricao10 vai aqui',
    'quiz_5dd2af8fe6957',
    '_CONTINUOUS_',
    NULL
);
/*--------------------item_picture-----------------------*/
INSERT INTO item_picture (
    id_item_picture,
    title,
    path
) VALUES (
    'item_picture_5dd2b4b484716',
    'imagem1',
    'imagem1.png'
);

INSERT INTO item_picture (
    id_item_picture,
    title,
    path
) VALUES (
    'item_picture_5dd2b4e99016b',
    'imagem2',
    'imagem2.png'
);

INSERT INTO item_picture (
    id_item_picture,
    title,
    path
) VALUES (
    'item_picture_5dd2b4f52f81e',
    'imagem3',
    'imagem3.png'
);

INSERT INTO item_picture (
    id_item_picture,
    title,
    path
) VALUES (
    'item_picture_5dd2b4febcc7f',
    'imagem4',
    'imagem4.png'
);

INSERT INTO item_picture (
    id_item_picture,
    title,
    path
) VALUES (
    'item_picture_5dd2b506dbc75',
    'imagem5',
    'imagem5.png'
);

INSERT INTO item_picture (
    id_item_picture,
    title,
    path
) VALUES (
    'item_picture_5dd2b5c38291e',
    'imagem6',
    'imagem6.png'
);

/*-------------------item_has_picture---------------------*/
INSERT INTO item_has_picture (
    item_picture_idPicture,
    item_idItem
) VALUES (
    'item_picture_5dd2b4b484716',
    'item_5dd2b12f5a712'
);

INSERT INTO item_has_picture (
    item_picture_idPicture,
    item_idItem
) VALUES (
    'item_picture_5dd2b4e99016b',
    'item_5dd2b12f5a712'
);

INSERT INTO item_has_picture (
    item_picture_idPicture,
    item_idItem
) VALUES (
    'item_picture_5dd2b4f52f81e',
    'item_5dd2b15e23431'
);

INSERT INTO item_has_picture (
    item_picture_idPicture,
    item_idItem
) VALUES (
    'item_picture_5dd2b4febcc7f',
    'item_5dd2b1796b524'
);

INSERT INTO item_has_picture (
    item_picture_idPicture,
    item_idItem
) VALUES (
    'item_picture_5dd2b506dbc75',
    'item_5dd2b18e3904e'
);

INSERT INTO item_has_picture (
    item_picture_idPicture,
    item_idItem
) VALUES (
    'item_picture_5dd2b5c38291e',
    'item_5dd2b12f5a712'
);

INSERT INTO item_has_picture (
    item_picture_idPicture,
    item_idItem
) VALUES (
    'item_picture_5dd2b5c38291e',
    'item_5dd2b15e23431'
);

INSERT INTO item_has_picture (
    item_picture_idPicture,
    item_idItem
) VALUES (
    'item_picture_5dd2b4febcc7f',
    'item_5dd2b18e3904e'
);

/*-------------------participant_answer_item--------------*/
INSERT INTO participant_answer_item (
    participant_idPerson,
    item_idItem,
    description,
    answer,
    data_hour
) VALUES (
    'person_5dd2ac1255e21',
    'item_5dd2b12f5a712',
    'descricao vai aqui',
    2.5,
    '2019-09-07 12:56:52'
);

INSERT INTO participant_answer_item (
    participant_idPerson,
    item_idItem,
    description,
    answer,
    data_hour
) VALUES (
    'person_5dd2ac1255e21',
    'item_5dd2b1796b524',
    'descricao vai aqui',
    0.5,
    '2019-09-06 11:00:36'
);

INSERT INTO participant_answer_item (
    participant_idPerson,
    item_idItem,
    description,
    answer,
    data_hour
) VALUES (
    'person_5dd2ac1255e21',
    'item_5dd2b18e3904e',
    'descricao vai aqui',
    1.5,
    '2019-11-08 17:30:36'
);

INSERT INTO participant_answer_item (
    participant_idPerson,
    item_idItem,
    description,
    answer,
    data_hour
) VALUES (
    'person_5dd2ac4490291',
    'item_5dd2b15e23431',
    'descricao vai aqui',
    3.5,
    '2019-09-09 18:24:36'
);

INSERT INTO participant_answer_item (
    participant_idPerson,
    item_idItem,
    description,
    answer,
    data_hour
) VALUES (
    'person_5dd2ac4490291',
    'item_5dd2b12f5a712',
    'descricao vai aqui',
    0.75,
    '2019-05-07 14:35:02'
);

INSERT INTO participant_answer_item (
    participant_idPerson,
    item_idItem,
    description,
    answer,
    data_hour
) VALUES (
    'person_5dd2ac4490291',
    'item_5dd2b41265a42',
    'descricao vai aqui',
    2.25,
    '2019-11-05 14:29:36'
);