/*-------------------------Person------------------*/
USE dacosys;
INSERT INTO person (
    id_person,
    type,
    name,
    email,
    password,
    sex,
    hometown_cep,
    color,
    birth_day,
    latest_access,
    latest_ip_access,
    supervisor_idPerson
) VALUES (
    1,
    '_ADMINISTRATOR_',
    'Nome',
    'email@email.com',
    '123456',
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
    sex,
    hometown_cep,
    color,
    birth_day,
    latest_access,
    latest_ip_access,
    supervisor_idPerson
) VALUES (
    2,
    '_RESEARCHER_',
    'Nome2',
    'email2@email.com',
    '5495959',
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
    sex,
    hometown_cep,
    color,
    birth_day,
    latest_access,
    latest_ip_access,
    supervisor_idPerson
) VALUES (
    3,
    '_PARTICIPANT_',
    'Nome3',
    'email3@email.com',
    '632512',
    '_M_',
    '37200000',
    '_PARDA_',
    '1986-01-07',
    '2017-10-05',
    '192168145200',
    NULL
);

/*------------------------telefone-------------------------*/
INSERT INTO telephone (
    person_idPerson,
    telephone
) VALUES (
    1,
    '99999999999'
);

INSERT INTO telephone (
    person_idPerson,
    telephone
) VALUES (
    1,
    '88888888888'
);

/*------------------necessidade especial-----------------*/

INSERT INTO special_needs (
    participant_idPerson,
    need
) VALUES (
    1,
    'cego'
);


/*---------------------------quiz------------------------*/
INSERT INTO quiz (
    id_quiz,
    start_date,
    end_date,
    status
) VALUES (
    1,
    '20190101',
    '20190102',
    1
);

/*---------------reseacher_access_quiz------------------*/
INSERT INTO reseacher_access_quiz (
    reseacher_idPerson,
    quiz_idQuiz
) VALUES (
    2,
    1
);

/*----------------------------item----------------------*/
INSERT INTO item (
    id_item,
    enunciation,
    quiz_idQuiz,
    answer_type,
    answer_discret_amount
) VALUES (
    1,
    'descricao vai aqui',
    1,
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
    2,
    'descricao2 vai aqui',
    1,
    '_CONTINUOUS_',
    NULL
);    

/*--------------------item_picture-----------------------*/
INSERT INTO item_picture (
    id_picture,
    title,
    path
) VALUES (
    1,
    'imagem1',
    'imagem1.png'
);

/*-------------------item_has_picture---------------------*/
INSERT INTO item_has_picture (
    item_picture_idPicture,
    item_idItem
) VALUES (
    1,
    2
);

/*-------------------participant_answer_item--------------*/
INSERT INTO participant_answer_item (
    participant_idPerson,
    item_idItem,
    description,
    answer,
    data_hour
) VALUES (
    3,
    2,
    'descriacao vai aqui',
    2.5,
    '2019-11-05 14:29:36'
);