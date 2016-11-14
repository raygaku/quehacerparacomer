<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class recetasController extends Controller
{
    public function cogerRecetas()
    {
      $resultados = array();
      session_start();
      if(isset($_SESSION['userid'])){ //Si hay una sesión iniciada va a mostrar las recetas calificadas por ese usuario junto con las NO calificadas


       $uid = $_SESSION['userid']; // Guarda el usuario en $uid
//        $recetas = DB::select(SELECT * FROM recetas);

        $validacion =  app('db')->select("SELECT receta_id FROM recetas_calificacion WHERE usuario_id = $uid"); //Valida que existan recetas calificadas por el usuario de la sesion
        if ($validacion == null) { // Si no exisen recetas calificadas por el usuario, entonces
          $results = app('db')->select("SELECT * FROM recetas"); // Selecciona todas las recetas existentes

          $resultados[] = $results;
          return $resultados;
        }
        else{ //Si sí existen recetas calificadas, entonces
          //Trae todos las columnas (osea todas las filas donde se cumpla esa condicion) de la tabla recetas junto con todas las columnas de la tabla recetas_calificacion y se unen en el campo de id de las tablas recetas y recetas_calificacion ya que son las mismas y se van a traer la filas dónde el usuario de la sesion sea igual al campo usuario_id de la tabla recetas_calificacion (ya que se van )
          $results = app('db')->select("SELECT r.id, r.titulo, r.texto, r.fecha_subida, r.status, r.corazones, r.portada, r.descripcion, r.categoria, rc.receta_id, rc.usuario_id, rc.calificacion FROM recetas AS r JOIN recetas_calificacion AS rc ON r.id = rc.receta_id WHERE {$uid} = rc.usuario_id ");
          //Al resultado anterior se le van a sumar las recetas restantes (no calificadas)
          $results2 = app('db')->select("SELECT * FROM recetas WHERE id NOT IN (SELECT receta_id FROM recetas_calificacion WHERE usuario_id = $uid)"); #Extrañamente primero se muestran las calificadas y luego las que no lo están; y cuando calificas una que NO está calificada, entonces se agrupa con las que ya lo están sobreescrbiendo el lugar dónde está la receta NO calificada más cercana o pegada o seguida a las que ya están calificadas ????
          $resultados[] = $results;
          $resultados[] = $results2;
          return $resultados;
          //

      }

        return $resultados;
      } else { // Si no hay una sesion iniciada, entonces
        $results = app('db')->select("SELECT * FROM recetas"); //Selecciona todas las recetas de la base de datos
        $resultados[] = $results;
        return $resultados;

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
       recetas.descripcion,recetas.categoria, recetas_calificacion.receta_id, recetas_calificacion.usuario_id, recetas_calificacion.calificacion FROM recetas JOIN pins ON pins.recetaid = recetas.id JOIN recetas_calificacion ON recetas.id = recetas_calificacion.receta_id WHERE pins.userid ={$uid} AND {$uid} = recetas_calificacion.usuario_id  ORDER  BY recetas.id DESC "
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


    public function recomendarRecetasAPI()
    {
      session_start();
      $uid = $_SESSION['userid'];
      $recetas_calificaciones_no = app('db')->select("SELECT * FROM recetas_calificacion WHERE usuario_id != $uid");
      $recetas_calificaciones_si = app('db')->select("SELECT * FROM recetas_calificacion WHERE usuario_id  = $uid");
      $todas_calificadas = app('db')->select("SELECT * FROM recetas_calificacion");
      $data = array(
        "mis_calificaciones" =>  $recetas_calificaciones_si,
        "las_demas_calificaciones" => $recetas_calificaciones_no,
        "todas_calificadas" =>$todas_calificadas,
        );
      return $data;
    }

 }
