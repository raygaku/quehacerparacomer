<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class recetasController extends Controller
{
    public function cogerRecetas()
    {
//        $recetas = DB::select(SELECT * FROM recetas);
        $results = app('db')->select("SELECT * FROM recetas");
//        $results = DB::table('recetas')->get();
        return $results;
    }


    public function cogerRecetasPorId(Request $request)
    {
        $id = $request->input('id');
        $results = app('db')->select("SELECT * FROM recetas WHERE id = {$id}");
        return $results;
    }

    public function recibirRecetaNueva(Request $request)
    {
        $titulo = $request->input('titulo');
        $receta = $request->input('receta');
        $descripcion = $request->input('descripcion');
        $query = app('db')->insert("INSERT INTO recetas (titulo,texto,descripcion) VALUES ('$titulo','$receta','$descripcion')");
        if($query)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
}

