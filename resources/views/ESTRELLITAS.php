<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $calificacion = $_GET['rating'];
  echo $calificacion;

  try {

    $conexion = new PDO('mysql:host=localhost;dbname=cocina_rico_db', 'root', '');

  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  $statement = $conexion->prepare('
    INSERT INTO recetas (calificacion) VALUES (:calificacion) '
  );

  $statement->execute(array(
    ':calificacion'=>$calificacion
    ));

}
else {
  echo "error";
}

?>
