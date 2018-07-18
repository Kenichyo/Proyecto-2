<?php

session_start();


$connect = mysqli_connect("localhost", "root", "smartdawn", "proyectosmart");
if(isset($_POST["hora1"]) && isset($_POST["minuto1"]) && isset($_POST["cantidad1"]) && isset($_POST["hora2"]) && isset($_POST["minuto2"]) && isset($_POST["cantidad2"])){
  $hora1 = mysqli_real_escape_string($connect, $_POST["hora1"]);
  $minuto1 = mysqli_real_escape_string($connect, $_POST["minuto1"]);
  $cantidad1 = mysqli_real_escape_string($connect, $_POST["cantidad1"]);
  $hora2 = mysqli_real_escape_string($connect, $_POST["hora2"]);
  $minuto2 = mysqli_real_escape_string($connect, $_POST["minuto2"]);
  $cantidad2 = mysqli_real_escape_string($connect, $_POST["cantidad2"]);
  $id = mysqli_real_escape_string($connect, $_SESSION["id"]);
  $result = "";

  $sql2 = "SELECT sn FROM dispensador WHERE id_user = '$id'";
  $resultado2 = mysqli_query($connect, $sql2);
  if (!$resultado2) {
    echo "<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error</strong><br>$resultado2</div>". mysql_error();
    exit;
  }else{
    $fila = mysqli_fetch_row($resultado2);
    $sn = $fila[0];
  }
  
  if ($result != "") {
    echo "<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error</strong><br>$result</div>";
  } else {
    $sql = "UPDATE dispensador SET hora1 = '$hora1', minuto1 = '$minuto1', cantidad1 = '$cantidad1', hora2 = '$hora2', minuto2 = '$minuto2', cantidad2 = '$cantidad2' where sn = '$sn'";
    mysqli_query($connect, $sql);
    echo "<div class='alert alert-dismissible alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Correcto!</strong><br>Se ha registrado correctamente.</div>";
  }
} else {
  echo "<div class='alert alert-dismissible alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Mal!</strong><br>Error</div>";
}

?>
