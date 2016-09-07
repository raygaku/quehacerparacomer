<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function ()  {
    return view("landing");
});

$app->get('/controlSudo', function(){
    return view("sudo");
});

$app->post('/recetas', 'recetasController@cogerRecetas');
$app->post('/cogerRecetaPorID', 'recetasController@cogerRecetasPorId');