<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class usuariosController extends Controller
{
  /*
  public function statusLogin()
  {
    session_start();
    $session = $_SESSION['userid'];
    return $session;
  }
  */

  public function obtenerAccesos()
  {
    session_start();
    $status = 0;
    if(!isset($_SESSION['userid'])){
      $session = 0;
    }
    else {
    $session = $_SESSION['userid'];
    }

    if($session > 0)
    {
      $status = 1;
    }

    if($status == 1)
    {
      $query = app('db')->select("SELECT * FROM accesos WHERE login = 1");
    }
    else {
      $query = app('db')->select("SELECT * FROM accesos WHERE login = 0");
    }

    return $query;
  }


  public function registrarUsuario(Request $request)
  {
    $correo = $request->input('correo');
    $pwd = md5($request->input('pwd'));
    $seleccion = app('db')->select("SELECT id FROM usuarios WHERE correo = '$correo'");
    if($seleccion == null)
    {
      $insertar = app('db')->insert("INSERT INTO `usuarios` (correo,password) VALUES ('$correo','$pwd')");
      $id= app('db')->select("SELECT MAX(id) AS id FROM usuarios");
      session_start();

      foreach ($id[0] as $key => $value) {
        $uid = $value;
      }
      $_SESSION['userid'] = $uid;
      return 0;

    }
    else {
      return 1;
    }
  }


  public function logout()
  {
    session_start();
    session_destroy();
  }


  public function login(Request $request)
  {
    session_start();
    $correo = $request->input('correo');
    $pwd = md5($request->input('pwd'));
    $seleccion = app('db')->select("SELECT id FROM usuarios WHERE correo = '$correo' AND password = '$pwd'");
    if($seleccion != null)
    {
      foreach ($seleccion[0] as $key => $value) {
        $uid = $value;
      }
      $_SESSION['userid'] = $uid;
      return 0;
    }
    else {
      return 1;
    }
  }

  public function pin(Request $request)
  {
    session_start();
    $recetaid = $request->input('recetaid');
    if(!isset($_SESSION['userid'])){
      return 1;
    }
    else {
      $userid = $_SESSION['userid'];

      $validar = app('db')->select("SELECT id FROM pins WHERE userid = {$userid} AND recetaid = {$recetaid}");

      if($validar == null)
      {
        $query = app('db')->insert("INSERT INTO pins (userid,recetaid) VALUES ({$userid},{$recetaid})");
      }

      return 0;

    }

  }
}
