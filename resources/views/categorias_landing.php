<?php


//session_destroy();

/**
 * Created by PhpStorm.
 * User: edgar
 * Date: 4/09/16
 * Time: 11:11 PM
 *
 * Decripción:
 * Página que aparece al entrar a la página donde se podrá acceder a todas las recetas
 */

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cocina Rico, Cocina Fácil</title>
    <script src="scripts/jquery/jquery-3.1.0.min.js"></script>
    <link rel="stylesheet" href="styles/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="sweetalert/sweetalert.css">
    <link rel="stylesheet" href="styles/iStyles/normal.css" >
    <script src="scripts/bootstrap/bootstrap.min.js"></script>
    <script src="scripts/angular/angular.min.js"></script>
    <script src="scripts/angular/modules/categorias-module.js"></script>
    <link rel="stylesheet" href="awesomplete/awesomplete.css" >
    <script src="awesomplete/awesomplete.min.js" charset="utf-8"></script>




    <script src="sweetalert/sweetalert.min.js"></script>




</head>
<body ng-app="lanapp" ng-controller="categoriasController">
<div class="container">
<div class="row">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Cocina Rico</a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li ><a href="/">Página Principal <span class="sr-only">(current)</span></a></li>

                    <li class="dropdown active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorias<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li ng-repeat="cat in categorias"><a ng-href="categoria={{cat.id}}">{{cat.nombre_categoria}}</a></li>

                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input id="ingenieur" class="form-control" placeholder="Buscar" />
                        <a href="#" data-toggle="modal" id="launcher" data-target="#myModal" style="display:none;">Leer</a>
                    </div>
                    <button  class="btn btn-default" ng-click="buscar()">Buscar</button>
                </form>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi Cuenta<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li ng-repeat="acc in accesos"><a ng-click="task(acc.funcion)"  data-toggle="modal" data-target="#myModal{{acc.ruta}}">{{acc.nombre}}</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>



    <div class="row">
        <div class="col-sm-6 col-md-4" ng-repeat="rec in recetasExistentes">
            <div class="thumbnail">
                <img ng-src="{{rec.portada}}" alt="..."  ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal">
                <div class="caption">
                    <h3 ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal">{{rec.titulo}}</h3>
                    <p ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal"> {{rec.descripcion}}</p>
                    <p><a href="#" class="btn btn-primary" role="button" ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal">Leer</a> <a href="#" class="btn btn-default" role="button" ng-click="pin(rec.id)">Guardar</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog"  ng-repeat="receta in recetaElegida">

        <!-- Modal content-->
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <img ng-src="{{receta.portada}}" class="img-circle" width="304" height="236" style="margin-left:22%;">
                <h4 class="modal-title">{{receta.titulo}}</h4>
            </div>
            <div class="modal-body">
                <pre>
                      {{receta.texto}}
                </pre>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>



<!-- Modal Login -->
<div class="modal fade" id="myModalLogin" role="dialog" >
    <div class="modal-dialog"  >

        <!-- Modal content-->
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <form class="form-signin">
                  <h2 class="form-signin-heading" id="headerLogin">Por favor, Iniciar Sesión</h2>
                  <div class="alert alert-danger" role="alert" id="alertaGuardar" style="display:none">Inicie sesión y vuelva a intentarlo.</div>
                  <label for="inputEmail" class="sr-only">Correo Electrónico</label>
                  <input type="email" id="inputEmail" class="form-control" placeholder="Dirección de correo" ng-model="userToLog.correo" required autofocus>
                  <label for="inputPassword" class="sr-only">Contraseña</label>
                  <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" ng-model="userToLog.pwd" required>

                  <button class="btn btn-lg btn-primary btn-block" id="loginBtn" ng-click="loginU()">Iniciar Sesión</button>
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>


<!-- Modal Register -->
<div class="modal fade" id="myModalRegister" role="dialog" >
    <div class="modal-dialog"  >

        <!-- Modal content-->
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <form class="form-signin">
                  <h2 class="form-signin-heading" id="headerLogin">Por favor, Registrate</h2>
                  <label for="inputEmail" class="sr-only">Correo Electrónico</label>
                  <input type="email" id="inputEmail" class="form-control" placeholder="Dirección de correo" ng-model="usuarioAregistrar.correo" required autofocus>
                  <label for="inputPassword" class="sr-only">Contraseña</label>
                  <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" ng-model="usuarioAregistrar.pwd" required>

                  <button class="btn btn-lg btn-primary btn-block" id="loginBtn" ng-click="registrarU()">Registrarse</button>
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

</div>




</body>
</html>
