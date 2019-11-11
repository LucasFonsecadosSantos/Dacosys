<?php

//System
$route[] = ['/',                    'DacosysController@index'];
$route[] = ['/logout',              'DacosysController@logout'];
$route[] = ['/sobre',               'DacosysController@about'];
$route[] = ['/reportar-problema',   'DacosysController@bugReport'];

//Researcher and Admin
$route[] = ['/login',                       'ResearcherController@login'];
$route[] = ['/pesquisadores',               'ResearcherController@researcherList'];
$route[] = ['/pesquisador/registrar',       'ResearcherController@researcherRegister'];
$route[] = ['/pesquisador/salvar',          'ResearcherController@researcherStore'];
$route[] = ['/pesquisador/{id}/remover',    'ResearcherController@researcherDelete'];
$route[] = ['/pesquisador/{id}/editar',     'ResearcherController@researcherEdit'];
$route[] = ['/pesquisador/atualizar',       'ResearcherController@researcherUpdate'];
$route[] = ['/pesquisador/{id}/visualizar', 'ResearcherController@researcherShow'];

//Participant entity
$route[] = ['/participar',                      'ParticipantController@participantLogin'];
$route[] = ['/participantes',                   'ParticipantController@participantList'];
$route[] = ['/participante/registrar',          'ParticipantController@participantRegister'];
$route[] = ['/participante/salvar',             'ParticipantController@participantStore'];
$route[] = ['/participante/{id}/remover',       'ParticipantController@participantDelete'];
$route[] = ['/participante/{id}/visualizar',    'ParticipantController@participantShow'];
$route[] = ['/participante/{id}/editar',        'ParticipantController@participantEdit'];
$route[] = ['/participante/atualizar',          'ParticipantController@participantUpdate'];


//Quiz
$route[] = ['/questionarios',                   'QuizController@list'];
$route[] = ['/questionario/registrar',          'QuizController@register'];
$route[] = ['/questionario/salvar',             'QuizController@store'];
$route[] = ['/questionario/{id}/visualizar',    'QuizController@show'];
$route[] = ['/questionario/{id}/editar',        'QuizController@edit'];
$route[] = ['/questionario/atualizar',          'QuizController@update'];
$route[] = ['/questionario/{id}/remover',       'QuizController@delete'];
$route[] = ['/questionario/{id}/estatisticas',  'QuizController@metrics'];


//Item
return $route;
$route[] = ['/pergunta/cadastrar',          'ItemController@register'];
$route[] = ['/pergunta/salvar',             'ItemController@store'];
$route[] = ['/pergunta/{id}/visualizar',    'ItemController@show'];
$route[] = ['/pergunta/{id}/responder',     'ItemController@answer'];
$route[] = ['/pergunta/{id}/editar',        'ItemController@edit'];
$route[] = ['/pergunta/atualizar',          'ItemController@update'];
$route[] = ['/pergunta/{id}/deletar',       'ItemController@remove'];
$route[] = ['/pergunta/remover',            'ItemController@delete'];

//Image
$route[] = ['/imagens',                 'ItemPictureController@list'];
$route[] = ['/imagens/upload',          'ItemPictureController@upload'];
$route[] = ['/imagens/{id}/registrar',  'ItemPictureController@register'];
$route[] = ['/imagens/salvar',          'ItemPictureController@store'];
$route[] = ['/imagens/{id}/deletar',    'ItemPictureController@remove'];
$route[] = ['/imagens/remover',         'ItemPictureController@delete'];
$route[] = ['/imagens/{id}/visualizar', 'ItemPictureController@show'];