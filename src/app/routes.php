<?php

//System
$route[] = ['/',                            'DacosysController@index'];
$route[] = ['/sobre',                       'DacosysController@about'];
$route[] = ['/reportar-problema',           'DacosysController@bugReport'];
$route[] = ['/gerar-chave-participante',    'DacosysController@keyGeneration'];

//Researcher and Admin
$route[] = ['/logout',                      'ResearcherController@logout'];
$route[] = ['/login',                       'ResearcherController@login'];
$route[] = ['/pesquisador/autenticar',      'ResearcherController@auth'];
$route[] = ['/pesquisadores',               'ResearcherController@listation'];
$route[] = ['/pesquisador/registrar',       'ResearcherController@register'];
$route[] = ['/pesquisador/salvar',          'ResearcherController@store'];
$route[] = ['/pesquisador/{id}/remover',    'ResearcherController@delete'];
$route[] = ['/pesquisador/{id}/editar',     'ResearcherController@edit'];
$route[] = ['/pesquisador/atualizar',       'ResearcherController@update'];
$route[] = ['/pesquisador/{id}/visualizar', 'ResearcherController@show'];

//Participant entity
$route[] = ['/participar',                      'ParticipantController@login'];
$route[] = ['/participantes',                   'ParticipantController@listation'];
$route[] = ['/participante/registrar',          'ParticipantController@register'];
$route[] = ['/participante/salvar',             'ParticipantController@store'];
$route[] = ['/participante/{id}/remover',       'ParticipantController@delete'];
$route[] = ['/participante/{id}/visualizar',    'ParticipantController@show'];
$route[] = ['/participante/{id}/editar',        'ParticipantController@edit'];
$route[] = ['/participante/atualizar',          'ParticipantController@update'];


//Quiz
$route[] = ['/questionarios',                           'QuizController@listation'];
$route[] = ['/questionario/registrar',                  'QuizController@register'];
$route[] = ['/questionario/salvar',                     'QuizController@store'];
$route[] = ['/questionario/{id}/responder',             'QuizController@answer'];
$route[] = ['/questionario/{id}/visualizar',            'QuizController@show'];
$route[] = ['/questionario/{id}/editar',                'QuizController@edit'];
$route[] = ['/questionario/{id}/registrar-pergunta',    'QuizController@itemStore'];
$route[] = ['/questionario/atualizar',                  'QuizController@update'];
$route[] = ['/questionario/{id}/remover',               'QuizController@delete'];
$route[] = ['/questionario/{id}/estatisticas',          'QuizController@metrics'];


//Item
$route[] = ['/pergunta/cadastrar',          'ItemController@register'];
$route[] = ['/pergunta/{id}/salvar-resposta',    'ItemController@storeAnswer'];
$route[] = ['/pergunta/salvar',             'ItemController@store'];
$route[] = ['/pergunta/{id}/visualizar',    'ItemController@show'];
$route[] = ['/pergunta/{id}/responder',     'ItemController@answer'];
$route[] = ['/pergunta/{id}/editar',        'ItemController@edit'];
$route[] = ['/pergunta/atualizar',          'ItemController@update'];
$route[] = ['/pergunta/{id}/deletar',       'ItemController@remove'];
$route[] = ['/pergunta/remover',            'ItemController@delete'];

//Image
$route[] = ['/imagens',                 'ItemPictureController@listation'];
$route[] = ['/imagens/upload',          'ItemPictureController@upload'];
$route[] = ['/imagens/{id}/registrar',  'ItemPictureController@register'];
$route[] = ['/imagens/salvar',          'ItemPictureController@store'];
$route[] = ['/imagens/{id}/deletar',    'ItemPictureController@remove'];
$route[] = ['/imagens/remover',         'ItemPictureController@delete'];
$route[] = ['/imagens/{id}/visualizar', 'ItemPictureController@show'];

return $route;