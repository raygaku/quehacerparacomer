<?php

/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 6/09/16
 * Time: 10:16 AM
 */
?>


<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administración para SU</title>
    <script src="scripts/jquery/jquery-3.1.0.min.js"></script>
    <link rel="stylesheet" href="styles/bootstrap/bootstrap.min.css">
    <script src="scripts/bootstrap/bootstrap.min.js"></script>
    <script src="scripts/angular/angular.min.js"></script>
    <script src="scripts/angular/modules/sudo-module.js"></script>
    <script src="sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sweetalert/sweetalert.css">


</head>
<body ng-app="sudoapp" ng-controller="MainController">
<div class="container">
    <div class="row">
      <h3>Subir receta</h3>
        <div class="col-md-12">

          <form name="upload" ng-submit="uploadFile()">
            <div class="form-group">
              <label for="usr">Imagen:</label>
              <input type="file" id="portada_receta" name="file" uploader-model="file">
              <button type="submit" class="btn btn-success" name="button">Subir portada</button>
            </div>
          </form>

            <div class="form-group">
                <label for="usr">Título:</label>
                <input type="text" class="form-control" id="titulo" ng-model="recetaObj.titulo">
                <label for="usr">
                  Clave Única de Portada
                </label>
                  <input type="text" name="cover_id" class="form-control" id="cover_id" ng-model="recetaObj.portada" disabled="true">
            </div>
            <div class="form-group">
                <label for="usr">Descripción:</label>
                <textarea class="form-control" rows="5" id="descripcion" ng-model="recetaObj.descripcion"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <h3><b>Texto</b></h3>
            <textarea class="form-control" rows="5" id="Receta" ng-model="recetaObj.texto" placeholder="Pon el título en la primer linea, que irá centrada">

            </textarea>

        </div>
        <div class="col-md-4">
            <h3>Categoria</h3>
            <select class="form-control" id="categoria" ng-model="recetaObj.categoria">
                <option ng-repeat="cat in categorias" value="{{cat.id}}">{{cat.nombre_categoria}}</option>
            </select>
        </div>
        <div class="col-md-12">
            <button class="btn btn-success" ng-click="publicarReceta()">Enviar Receta</button>
        </div>

    </div>
    <div class="row">
      <div class="col-md-12">
        <h3>Manejar Categorias</h3>
      </div>

      <div class="col-md-12">
        <label>Desactivar Categorias</label>
        <select  id="categoria" ng-model="categoriaADesactivar.id">
            <option ng-repeat="cat in categorias" value="{{cat.id}}">{{cat.nombre_categoria}}</option>
        </select>
        <button type="button" name="btn-desactivar" class="btn btn-danger" ng-click="desactivarCategoria()">Desactivar</button>
      </div>

      <div class="col-md-12">
        <label>Activar Categorias</label>
        <select  id="categoria" ng-model="categoriaAactivar.id">
            <option ng-repeat="cat in categoriasDesactivadas" value="{{cat.id}}">{{cat.nombre_categoria}}</option>
        </select>
        <button type="button" name="btn-activar" class="btn btn-success" ng-click="activarCategoria()">Activar</button>
      </div>

      <div class="col-md-12">
        <label>Añadir categoria</label>
        <input type="text" name="nuevaCat" class="form-control" placeholder="Ingresa el nombre de la nueva categoria" ng-model="nuevaCategoria.nombre">
        <button type="button" name="btn-enviarCat" class="btn  btn-info" ng-click="agregarCategoria()">Agregar categoria</button>
      </div>

      <div class="col-md-12">
        <button type="button" class="btn btn-warning" name="logout" ng-click="cerrarSesion()">Salir</button>
      </div>
    </div>

</div>

</body>
</html>
