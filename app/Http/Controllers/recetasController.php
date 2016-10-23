<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class recetasController extends Controller
{
    public function cogerRecetas()
    {
//        $recetas = DB::select(SELECT * FROM recetas);
        $results = app('db')->select("SELECT * FROM recetas ORDER  BY id DESC");
//        $results = DB::table('recetas')->get();
        return $results;
    }

    public function cogerTitulos()
    {
      $results = app('db')->select("SELECT titulo, id FROM recetas");
      $titulos = array();
      for($i = 0; $i < count($results) ; $i++)
      {
        foreach ($results[$i] as $key => $value) {
            $titulos[] = $value;
        }
      }

      return $titulos;
    }


    public function cogerRecetasPorId(Request $request)
    {
        $id = $request->input('id');
        $results = app('db')->select("SELECT * FROM recetas WHERE id = {$id}");
        return $results;
    }

    public function recibirPortadaReceta()
    {

      $today = getdate();

      $file = $_FILES["file"]["name"];

      if(!is_dir("files/"))
        mkdir("files/",0777);

      if($file && move_uploaded_file($_FILES["file"]["tmp_name"], "files/".$file))
      {
        rename("files/".$file, "files/".$today[0].$file);
        $ruta = "files/".$today[0].$file;
        $claveNombre = explode(".",$file);
        $clave = $today[0].$claveNombre[0];

        $query = app('db')->insert("INSERT INTO `portada-receta` (ruta,clave) VALUES ('$ruta','$clave')");
        return $ruta;
      }

      return 1;
    }

    public function recibirRecetaNueva(Request $request)
    {
        $titulo = $request->input('titulo');
        $receta = $request->input('texto');
        $descripcion = $request->input('descripcion');
        $categoria = $request->input('categoria');
        $descripcion = $request->input('descripcion');
        $portada = $request->input('portada');



        $query = app('db')->insert("INSERT INTO recetas (titulo,texto,portada,descripcion,categoria) VALUES ('$titulo','$receta','$portada','$descripcion',{$categoria})");
        if($query)
        {
            return 1;
        }
        else
        {
            return 0;
        }

        return 101;
    }


    public function obtenerMisRecetas()
    {
      session_start();
      $uid = $_SESSION['userid'];
      $query = app('db')->select(
      "SELECT pins.userid, pins.recetaid , recetas.id, recetas.titulo, recetas.texto,recetas.status, recetas.corazones, recetas.portada,
       recetas.descripcion,recetas.categoria FROM recetas JOIN pins ON pins.recetaid = recetas.id WHERE pins.userid ={$uid} ORDER  BY recetas.id DESC "
    );

    return $query;
    }
}
