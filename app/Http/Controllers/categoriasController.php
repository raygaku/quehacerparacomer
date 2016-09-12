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

}