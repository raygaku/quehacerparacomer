<?php
session_start();


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
    <title>Cocina Rico | Cocina Fácil</title>
    <meta name="description" content="Recetas de cocina para cuando no sabes que hacer para comer">
    <meta name="keywords" content="que hacer para comer, que comer hoy, comer sano , que cocino hoy , postres deliciosos">
    <meta name="author" content="Hola Stdio!">

    <script src="scripts/jquery/jquery-3.1.0.min.js"></script>
    <link rel="icon" type="image/png" href="/files/stand.png" />
    <link rel="stylesheet" href="styles/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="sweetalert/sweetalert.css">
    <link rel="stylesheet" href="styles/iStyles/normal.css" >
    <script src="scripts/bootstrap/bootstrap.min.js"></script>
    <script src="scripts/angular/angular.min.js"></script>
    <script src="scripts/angular/modules/landing-module.js"></script>
    <link rel="stylesheet" href="awesomplete/awesomplete.css" >
    <script src="awesomplete/awesomplete.min.js" charset="utf-8"></script>




    <script src="sweetalert/sweetalert.min.js"></script>

    <style media="screen">
    @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

    fieldset, label { margin: 0; padding: 0; }
    body{ margin: 20px; }
    h1 { font-size: 1.5em; margin: 10px; }

    /****** Style Star Rating Widget *****/

    .rating {
    border: none;
    float: left;
    }

    .rating > input { display: none; }
    .rating > label:before {
    margin: 5px;
    font-size: 1.25em;
    font-family: FontAwesome;
    display: inline-block;
    content: "\f005";
    }

    .rating > .half:before {
    content: "\f089";
    position: absolute;
    }

    .rating > label {
    color: #ddd;
    float: right;
    }

    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating > input:checked ~ label, /* show gold star when clicked */
    .rating:not(:checked) > label:hover, /* hover current star */
    .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

    .rating > input:checked + label:hover, /* hover current star when changing rating */
    .rating > input:checked ~ label:hover,
    .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
    .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }
    </style>




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
                <a class="navbar-brand marca" href="/" >¿Qué hacer para comer?</a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Página Principal <span class="sr-only">(current)</span></a></li>

                    <li class="dropdown">
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
        <div class="col-sm-6 col-md-4" ng-repeat="rec in recetasExistentesNoRevisadas">
            <div class="thumbnail " >
                <img ng-src="{{rec.portada}}" alt="..."  ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal" style="max-height: 16em;" class="img-thumbnail">
                <div class="caption">
                    <h3 ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal">{{rec.titulo}}</h3>
                    <p ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal"> {{rec.descripcion}}</p>











                    <form ng-controller="MainController" name="login">
                    <fieldset class="rating">

                        <input ng-click="enviarCalf(rec.id,5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star5" name="rating" value="5" /><label class = "full" for="{{rec.id}}star5" title="Awesome - 5 stars"></label>
                        <input ng-click="enviarCalf(rec.id,4.5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star4half" name="rating" value="4.5" /><label class="half" for="{{rec.id}}star4half" title="Pretty good - 4.5 stars"></label>
                        <input ng-click="enviarCalf(rec.id,4)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star4" name="rating" value="4" /><label class = "full" for="{{rec.id}}star4" title="Pretty good - 4 stars"></label>
                        <input ng-click="enviarCalf(rec.id,3.5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star3half" name="rating" value="3.5" /><label class="half" for="{{rec.id}}star3half" title="Meh - 3.5 stars"></label>
                        <input ng-click="enviarCalf(rec.id,3)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star3" name="rating" value="3" /><label class = "full" for="{{rec.id}}star3" title="Meh - 3 stars"></label>
                        <input ng-click="enviarCalf(rec.id,2.5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star2half" name="rating" value="2.5" /><label class="half" for="{{rec.id}}star2half" title="Kinda bad - 2.5 stars"></label>
                        <input ng-click="enviarCalf(rec.id,2)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star2" name="rating" value="2" /><label class = "full" for="{{rec.id}}star2" title="Kinda bad - 2 stars"></label>
                        <input ng-click="enviarCalf(rec.id,1.5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star1half" name="rating" value="1.5" /><label class="half" for="{{rec.id}}star1half" title="Meh - 1.5 stars"></label>
                        <input ng-click="enviarCalf(rec.id,1)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star1" name="rating" value="1" /><label class = "full" for="{{rec.id}}star1" title="Sucks big time - 1 star"></label>
                        <input ng-click="enviarCalf(rec.id,0.5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}starhalf" name="rating" value="0.5" /><label class="half" for="{{rec.id}}starhalf" title="Sucks big time - 0.5 stars"></label>

                    </fieldset>




                    </form>





                    <p><a href="#" class="btn btn-primary" role="button" ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal">Leer</a><a href="#" class="btn btn-default" role="button" ng-click="pin(rec.id)">Guardar</a>
                  </p>









                </div>
            </div>
        </div>


        <div class="col-sm-6 col-md-4" ng-repeat="rec in recetasExistentesRevisadas">
            <div class="thumbnail " >
                <img ng-src="{{rec.portada}}" alt="..."  ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal" style="max-height: 16em;" class="img-thumbnail">
                <div class="caption">
                    <h3 ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal">{{rec.titulo}}</h3>
                    <p ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal"> {{rec.descripcion}}</p>











                    <form ng-controller="MainController" name="login">
                    <fieldset class="rating">

                        <input ng-click="enviarCalf(rec.id,5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star5" name="rating" value="5" /><label class = "full" for="{{rec.id}}star5" title="Awesome - 5 stars"></label>
                        <input ng-click="enviarCalf(rec.id,4.5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star4half" name="rating" value="4.5" /><label class="half" for="{{rec.id}}star4half" title="Pretty good - 4.5 stars"></label>
                        <input ng-click="enviarCalf(rec.id,4)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star4" name="rating" value="4" /><label class = "full" for="{{rec.id}}star4" title="Pretty good - 4 stars"></label>
                        <input ng-click="enviarCalf(rec.id,3.5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star3half" name="rating" value="3.5" /><label class="half" for="{{rec.id}}star3half" title="Meh - 3.5 stars"></label>
                        <input ng-click="enviarCalf(rec.id,3)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star3" name="rating" value="3" /><label class = "full" for="{{rec.id}}star3" title="Meh - 3 stars"></label>
                        <input ng-click="enviarCalf(rec.id,2.5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star2half" name="rating" value="2.5" /><label class="half" for="{{rec.id}}star2half" title="Kinda bad - 2.5 stars"></label>
                        <input ng-click="enviarCalf(rec.id,2)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star2" name="rating" value="2" /><label class = "full" for="{{rec.id}}star2" title="Kinda bad - 2 stars"></label>
                        <input ng-click="enviarCalf(rec.id,1.5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star1half" name="rating" value="1.5" /><label class="half" for="{{rec.id}}star1half" title="Meh - 1.5 stars"></label>
                        <input ng-click="enviarCalf(rec.id,1)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}star1" name="rating" value="1" /><label class = "full" for="{{rec.id}}star1" title="Sucks big time - 1 star"></label>
                        <input ng-click="enviarCalf(rec.id,0.5)" ng-model="rec.calificacion" type="radio" id="{{rec.id}}starhalf" name="rating" value="0.5" /><label class="half" for="{{rec.id}}starhalf" title="Sucks big time - 0.5 stars"></label>

                    </fieldset>




                    </form>





                    <p><a href="#" class="btn btn-primary" role="button" ng-click="leer(rec.id)" data-toggle="modal" data-target="#myModal">Leer</a><a href="#" class="btn btn-default" role="button" ng-click="pin(rec.id)">Guardar</a>
                  </p>









                </div>
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
                <img ng-src="{{receta.portada}}"  class="img-circle img-responsive"  style="margin-left:25%;width:50%;">
                <h4 class="modal-title">{{receta.titulo}}</h4>
                <p>
                  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- quehacerparacomer recetas -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2520617391431043"
     data-ad-slot="8250536410"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
                </p>
            </div>
            <div class="modal-body">
              <!--
                <pre>
                      {{receta.texto}}
                </pre>

              <textarea id="recetaCuerpo" disabled="true">
                  {{receta.texto}}
              </textarea>

            -->


          <pre id="recetaCuerpo">
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

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- quehacerparacomer -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-2520617391431043"
     data-ad-slot="1939977611"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-85470308-1', 'auto');
  ga('send', 'pageview');

</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.0/annyang.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/SpeechKITT/0.3.0/speechkitt.min.js"></script>

</body>
</html>
