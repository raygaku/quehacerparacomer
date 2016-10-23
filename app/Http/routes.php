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

$app->get('/categoria={categoria}','categoriasController@obtenerVista');

$app->get('/controlSudo', function(){
    return view("sudo");
});

$app->post('/recetas', 'recetasController@cogerRecetas');
$app->post('/cogerRecetaPorID', 'recetasController@cogerRecetasPorId');
$app->post('/recogerNuevaReceta','recetasController@recibirRecetaNueva');
$app->post('/cogerCategorias', 'categoriasController@cogerCategorias');
$app->post('/cogerPoradaReceta','recetasController@recibirPortadaReceta');
$app->post('/cogerRecetaPorCategoria','categoriasController@obtenerRecetasDeCategoria');
$app->post('/cogerTitulosRecetas', 'recetasController@cogerTitulos');
$app->post('/loginStatus','usuariosController@statusLogin');
$app->post('/obtenerAccesos','usuariosController@obtenerAccesos');
$app->post('/registrarUsuario','usuariosController@registrarUsuario');
$app->post('/logout','usuariosController@logout');
$app->post('/login','usuariosController@login');
$app->post('/pin','usuariosController@pin');
