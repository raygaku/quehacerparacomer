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
















$app->get('pruebaa', function(){ //En esa ruta va ejecutar la funcion que recibe como segundo parametro
  return "Hola desde routes.php";
});

$app->get('prueba22/{nombre}', function ($nombre){ //En esa ruta se le da un parametro obligatorio encerrado entre {} y va ejecutar una función que recibe como parámetro el valor antes dado
  return "Mi nombre es: ".$nombre;
});

$app->get('edad/{edad}', function ($edad){
  return "Mi edad es: ".$edad;
});

$app->get('edad2/{edad?}', function ($edad = 20){ //En esa ruta se le da un parámetro opcional con el signo de ?, si se da el parámetro, imprime ese parámetro, caso contrario imprime el default
  return "Mi edad es: ".$edad;
});







$app->get('/categoria={categoria}','categoriasController@obtenerVista');
$app->get('/misRecetas',function(){
  return view("misrecetas");
});

$app->get('/sudosu', function(){
    return view("sudoLogin");
});




$app->get('/sudoPanel', ['middleware' => 'checkSudo', function () {
    return view("sudo");
}]);











$app->post('/recomendarRecetasAPI','recetasController@recomendarRecetasAPI');
$app->post('/calificar', 'recetasController@guardarCalificacion');
$app->post('/recetas', 'recetasController@cogerRecetas');
$app->post('/cogerRecetaPorID', 'recetasController@cogerRecetasPorId');
$app->post('/recogerNuevaReceta','recetasController@recibirRecetaNueva');
$app->post('/cogerCategorias', 'categoriasController@cogerCategorias');
$app->post('/cogerCategoriasDesactivadas', 'categoriasController@cogerCategoriasDesactivadas');
$app->post('/desactivarCategoria', 'categoriasController@desactivarCategoria');
$app->post('/activarCategoria', 'categoriasController@activarCategoria');
$app->post('/agregarCategoria', 'categoriasController@agregarCategoria');
$app->post('/cogerPortadaReceta','recetasController@recibirPortadaReceta');
$app->post('/cogerRecetaPorCategoria','categoriasController@obtenerRecetasDeCategoria');
$app->post('/cogerTitulosRecetas', 'recetasController@cogerTitulos');
$app->post('/loginStatus','usuariosController@statusLogin');
$app->post('/obtenerAccesos','usuariosController@obtenerAccesos');
$app->post('/registrarUsuario','usuariosController@registrarUsuario');
$app->post('/logout','usuariosController@logout');
$app->post('/login','usuariosController@login');
$app->post('/pin','usuariosController@pin');
//$app->post('/obtenerUsrId','usuariosController@obtenerId');
$app->post('/obtenerMisRecetas','recetasController@obtenerMisRecetas');
$app->post('/sudoLogin','usuariosController@sudoLogin');
