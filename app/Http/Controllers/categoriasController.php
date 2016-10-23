<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class categoriasController extends Controller
{


    public function cogerCategorias()
    {
//        $recetas = DB::select(SELECT * FROM recetas);
        $results = app('db')->select("SELECT * FROM categorias WHERE status = 1");
//        $results = DB::table('recetas')->get();
        return $results;
    }

    public function cogerCategoriasDesactivadas()
    {
//        $recetas = DB::select(SELECT * FROM recetas);
        $results = app('db')->select("SELECT * FROM categorias WHERE status = 0");
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

    public function desactivarCategoria(Request $r)
    {
      $id = $r->input('id');
      $query = app('db')->update("UPDATE categorias SET status = 0 WHERE id = {$id}");
      return 0;
    }

    public function activarCategoria(Request $r)
    {
      $id = $r->input('id');
      $query = app('db')->update("UPDATE categorias SET status = 1 WHERE id = {$id}");
      return 0;
    }

    public function agregarCategoria(Request $r)
    {
      $nombre = $r->input('nombre');
      $validar = app('db')->select("SELECT * FROM categorias WHERE nombre_categoria = '$nombre'");
      if($validar == null)
      {
        $query = app('db')->insert("INSERT INTO categorias (valor, nombre_categoria) VALUES ('$nombre','$nombre')");
        return 0;
      }
      else {
        return 1;
      }

    }

}
