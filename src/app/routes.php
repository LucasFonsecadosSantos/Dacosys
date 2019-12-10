<?php

//System
$route[] = ['/',                            'DacosysController@index', 'auth'];
$route[] = ['/sobre',                       'DacosysController@about', 'auth'];
$route[] = ['/reportar-problema',           'DacosysController@bugReport', 'auth'];
$route[] = ['/gerar-chave-participante',    'DacosysController@keyGeneration', 'auth'];

//Researcher and Admin
$route[] = ['/logout',                      'ResearcherController@logout'];
$route[] = ['/login',                       'ResearcherController@login'];
$route[] = ['/pesquisador/autenticar',      'ResearcherController@auth'];
$route[] = ['/pesquisadores',               'ResearcherController@listation', 'auth'];
$route[] = ['/pesquisador/registrar',       'ResearcherController@register'];
$route[] = ['/pesquisador/salvar',          'ResearcherController@store'];
$route[] = ['/pesquisador/{id}/remover',    'ResearcherController@delete', 'auth'];
$route[] = ['/pesquisador/{id}/editar',     'ResearcherController@edit', 'auth'];
$route[] = ['/pesquisador/atualizar',       'ResearcherController@update', 'auth'];
$route[] = ['/pesquisador/{id}/visualizar', 'ResearcherController@show', 'auth'];

//Participant entity
$route[] = ['/participar',                      'ParticipantController@login'];
$route[] = ['/participantes',                   'ParticipantController@listation', 'auth'];
$route[] = ['/participante/registrar',          'ParticipantController@register'];
$route[] = ['/participante/salvar',             'ParticipantController@store'];
$route[] = ['/participante/{id}/remover',       'ParticipantController@delete', 'auth'];
$route[] = ['/participante/{id}/visualizar',    'ParticipantController@show', 'auth'];
$route[] = ['/participante/{id}/editar',        'ParticipantController@edit', 'auth'];
$route[] = ['/participante/atualizar',          'ParticipantController@update', 'auth'];


//Quiz
$route[] = ['/questionarios',                           'QuizController@listation', 'auth'];
$route[] = ['/questionario/registrar',                  'QuizController@register', 'auth'];
$route[] = ['/questionario/salvar',                     'QuizController@store'];
$route[] = ['/questionario/{id}/responder',             'QuizController@answer'];
$route[] = ['/questionario/{id}/visualizar',            'QuizController@show', 'auth'];
$route[] = ['/questionario/{id}/editar',                'QuizController@edit', 'auth'];
$route[] = ['/questionario/{id}/registrar-pergunta',    'QuizController@itemStore', 'auth'];
$route[] = ['/questionario/atualizar',                  'QuizController@update', 'auth'];
$route[] = ['/questionario/{id}/remover',               'QuizController@delete', 'auth'];
$route[] = ['/questionario/{id}/estatisticas',          'QuizController@metrics', 'auth'];
$route[] = ['/questionario/agradecimento',              'QuizController@thanks'];


//Item
$route[] = ['/pergunta/cadastrar',          'ItemController@register', 'auth'];
$route[] = ['/pergunta/{id}/salvar-resposta',    'ItemController@storeAnswer'];
$route[] = ['/pergunta/salvar',             'ItemController@store'];
$route[] = ['/pergunta/{id}/visualizar',    'ItemController@show', 'auth'];
$route[] = ['/pergunta/{id}/responder',     'ItemController@answer'];
$route[] = ['/pergunta/{id}/editar',        'ItemController@edit', 'auth'];
$route[] = ['/pergunta/atualizar',          'ItemController@update', 'auth'];
$route[] = ['/pergunta/{id}/deletar',       'ItemController@remove', 'auth'];
$route[] = ['/pergunta/remover',            'ItemController@delete', 'auth'];

//Image
$route[] = ['/imagens',                 'ItemPictureController@listation', 'auth'];
$route[] = ['/imagens/upload',          'ItemPictureController@upload', 'auth'];
$route[] = ['/imagens/{id}/registrar',  'ItemPictureController@register', 'auth'];
$route[] = ['/imagens/salvar',          'ItemPictureController@store', 'auth'];
$route[] = ['/imagens/{id}/deletar',    'ItemPictureController@remove', 'auth'];
$route[] = ['/imagens/remover',         'ItemPictureController@delete', 'auth'];
$route[] = ['/imagens/{id}/visualizar', 'ItemPictureController@show', 'auth'];

return $route;