<?php

?>
<!DOCTYPE html>
<html>
  <head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cocina Rico, Cocina Fácil</title>
        <script src="scripts/jquery/jquery-3.1.0.min.js"></script>
        <link rel="stylesheet" href="styles/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="sweetalert/sweetalert.css">
        <link rel="stylesheet" href="styles/iStyles/sudo.css" >
        <script src="scripts/bootstrap/bootstrap.min.js"></script>
        <script src="scripts/angular/angular.min.js"></script>
        <link rel="stylesheet" href="awesomplete/awesomplete.css" >
        <script src="scripts/angular/modules/sudoLogin-module.js"></script>
        <script src="awesomplete/awesomplete.min.js" charset="utf-8"></script>




        <script src="sweetalert/sweetalert.min.js"></script>




    </head>
  <body ng-app="sudoapp" ng-controller="MainController">
    <div class = "container">
	<div class="wrapper">
		<form name="Login_Form" class="form-signin">
		    <h3 class="form-signin-heading">Hola de Nuevo, SU!</h3>
			  <hr class="colorgraph"><br>

			  <input type="text" class="form-control" name="Username" placeholder="Username" required="" autofocus="" ng-model="sudoLog.username"/>
			  <input type="password" class="form-control" name="Password" placeholder="Password" required="" ng-model="sudoLog.password"/>

			  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" ng-click="sudoLogin()">Login</button>
		</form>
	</div>
</div>

  </body>
</html>
