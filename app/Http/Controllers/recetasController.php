<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class recetasController extends Controller
{
    public function cogerRecetas()
    {
      session_start();
      if(isset($_SESSION['userid'])){


       $uid = $_SESSION['userid'];
//        $recetas = DB::select(SELECT * FROM recetas);
        
        $validacion =  app('db')->select("SELECT receta_id FROM recetas_calificacion WHERE usuario_id = $uid");
        if ($validacion == '') {
          $results = app('db')->select("SELECT * FROM recetas");
        }
        else{
          $results = app('db')->select("SELECT r.id, r.titulo, r.texto, r.fecha_subida, r.status, r.corazones, r.portada, r.descripcion, r.categoria, rc.receta_id, rc.usuario_id, rc.calificacion FROM recetas AS r JOIN recetas_calificacion AS rc ON r.id = rc.receta_id WHERE {$uid} = rc.usuario_id ");
        $results += app('db')->select("SELECT * FROM recetas WHERE id NOT IN (SELECT receta_id FROM recetas_calificacion WHERE usuario_id = $uid) ");
      }
        return $results;
      }else {
        $results = app('db')->select("SELECT * FROM recetas");
        return $results;
      }
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

    public function guardarCalificacion(Request $request)
    {
      session_start();
      if(isset($_SESSION['userid'])){
      $uid = $_SESSION['userid'];
      $rating = $request->input('rating');
      $rid = $request->input('rid');
      $validacion = app('db')->select("SELECT * FROM recetas_calificacion WHERE receta_id = $rid AND $uid = usuario_id ");
      if ($validacion == null) { //SI es nulo se puede inertar
        $query = app('db')->insert("INSERT INTO recetas_calificacion (usuario_id,calificacion,receta_id) VALUES ($uid,$rating,$rid) ");
      } else {
        $query = app('db')->update("UPDATE recetas_calificacion SET calificacion= $rating WHERE receta_id = $rid AND $uid = usuario_id ");
      }


      return 0;
    } else {
      return 1;
    }
    }
 }
