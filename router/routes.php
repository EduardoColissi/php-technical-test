<?php

$routes = [
    '/' => 'UserController@index',
    '/testeComParametro/{id}' => 'UserController@testeComParametro',
    '/testeComQuery'=> 'UserController@testeComQuery',
    '/testeAction' => 'UserController@testeAction',
];