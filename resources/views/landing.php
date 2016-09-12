<?php
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
    <script src="scripts/bootstrap/bootstrap.min.js"></script>
    <script src="scripts/angular/angular.min.js"></script>
    <script src="scripts/angular/modules/landing-module.js"></script>
    <!-- Main Quill library -->
    <script src="scripts/quill/quill.min.js" type="text/javascript"></script>

    <!-- Theme included stylesheets -->
    <link href="styles/quill/quill.snow.css" rel="stylesheet">



</head>
<body ng-app="lanapp" ng-controller="MainController">
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
                <a class="navbar-brand" href="#">Cocina Rico</a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Página Principal <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorias<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Postres</a></li>
                            <li><a href="#">Pastas</a></li>
                            <li><a href="#">Cremas</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi Cuenta<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Iniciar Sesión</a></li>
                            <li><a href="#">Registrarme</a></li>
                            <li><a href="#">Mis recetas</a></li>
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
                <img ng-src="{{rec.portada_receta}}" alt="..."  ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal">
                <div class="caption">
                    <h3 ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal">{{rec.titulo}}</h3>
                    <p ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal"> {{rec.descripcion}}</p>
                    <p><a href="#" class="btn btn-primary" role="button" ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal">Leer</a> <a href="#" class="btn btn-default" role="button">Guardar</a></p>
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
                <h4 class="modal-title">{{receta.titulo}}</h4>
            </div>
            <div class="modal-body">
                <div id="editor">
<!--                    {{receta.texto}}-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

</div>

<script type="text/javascript">
    var quill = new Quill('#editor', {
        theme: 'snow',
        readOnly : true,
    });

    var setear = function(setear)
    {
        console.log("Si entro a setear")

//        quill.setText(setear)
        console.log(setear)
    }

</script>
</body>
</html>
