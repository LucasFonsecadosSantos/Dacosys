<?php

$route[] = ['/', 'DacosysController@index'];
$route[] = ['/logout', 'DacosysController@logout'];
$route[] = ['/participar', 'Person@participantLogin'];
$route[] = ['/login', 'Person@login'];
$route[] = ['/participante/registrar', 'Person@participantRegister'];

return $route;