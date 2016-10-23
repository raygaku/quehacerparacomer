<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class categoriasController extends Controller
{


    public function cogerCategorias()
    {
//        $recetas = DB::select(SELECT * FROM recetas);
        $results = app('db')->select("SELECT * FROM categorias");
//        $results = DB::table('recetas')->get();
        return $results;
    }

    public function obtenerVista($categoria)
    {
      session_start();
      $_SESSION['categoriaDeseada'] = $categoria;

      return view('categorias_landing');
    }

    public function obtenerRecetasDeCategoria()
    {
      session_start();
      $categoria = $_SESSION['categoriaDeseada'];
      $results = app('db')->select("SELECT * FROM recetas WHERE categoria = {$categoria}");
      return $results;
    }

}
