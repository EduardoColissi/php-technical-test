<?php

$routes = [
    '/' => 'UserController@index',
    '/create' => 'UserController@add',
    '/load' => 'UserController@load',
    '/loadById/{id}' => 'UserController@loadById',
    '/update/{id}' => 'UserController@update',
    '/delete/{id}' => 'UserController@delete',
];