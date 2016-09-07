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
    <!-- Main Quill library -->
    <script src="scripts/quill/quill.min.js" type="text/javascript"></script>

    <!-- Theme included stylesheets -->
    <link href="styles/quill/quill.snow.css" rel="stylesheet">


</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="usr">Título:</label>
                <input type="text" class="form-control" id="titulo">
            </div>
        </div>
        <div class="col-md-12">
            <div id="editor">

            </div>
            <button onclick="aver()">Que hay</button>
        </div>
    </div>
</div>


<script type="text/javascript">
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Escribe la receta aquí!'
    });


    var aver  = function()
    {
        var delta = quill.getText();
        console.log(delta)

    }
</script>

</body>
</html>
