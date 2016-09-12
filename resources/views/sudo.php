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


</head>
<body ng-app="sudoapp" ng-controller="MainController">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="usr">Título:</label>
                <input type="text" class="form-control" id="titulo" ng-model="recetaObj.titulo">
            </div>
            <div class="form-group">
                <label for="usr">Descripción:</label>
                <textarea class="form-control" rows="5" id="descripcion" ng-model="recetaObj.descripcion"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <h3><b>Texto</b></h3>
            <textarea class="form-control" rows="5" id="Receta" ng-model="recetaObj.texto"></textarea>

        </div>
        <div class="col-md-4">
            <h3>Categoria</h3>
            <select class="form-control" id="categoria" ng-model="recetaObj.categoria">
                <option value="postres">Postres</option>
                <option value="pastas">Pastas</option>
                <option value="cremas">Cremas</option>
                <option value="antojitos">Antojitos</option>
            </select>
        </div>
        <div class="col-md-12">
            <button class="btn btn-success" ng-click="publicarReceta()">Enviar Receta</button>
        </div>

    </div>
</div>

</body>
</html>
