<?php

session_start();


$connect = mysqli_connect("localhost", "root", "smartdawn", "proyectosmart");
if(isset($_POST["hora1"]) && isset($_POST["minuto1"]) && isset($_POST["hora2"]) && isset($_POST["minuto2"]) && isset($_POST["hora3"]) && isset($_POST["minuto3"])){
  $hora1 = mysqli_real_escape_string($connect, $_POST["hora1"]);
  $minuto1 = mysqli_real_escape_string($connect, $_POST["minuto1"]);
  $hora2 = mysqli_real_escape_string($connect, $_POST["hora2"]);
  $minuto2 = mysqli_real_escape_string($connect, $_POST["minuto2"]);
  $hora3 = mysqli_real_escape_string($connect, $_POST["hora3"]);
  $minuto3 = mysqli_real_escape_string($connect, $_POST["minuto3"]);
  $id = mysqli_real_escape_string($connect, $_SESSION["id"]);
  $result = "";

  $sql1 = "SELECT sn FROM adaptador WHERE id_user = '$id'";
  $resultado1 = mysqli_query($connect, $sql1);
  if (!$resultado1) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
  }else{
    $fila = mysqli_fetch_row($resultado1);
    $sn = $fila[0];
  }
  
  if ($result != "") {
    echo "<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error</strong><br>$result</div>";
  } else {
    $sql = "UPDATE adaptador SET hora1 = '$hora1', minuto1 = '$minuto1', hora2 = '$hora2', minuto2 = '$minuto2', hora3 = '$hora3', minuto3 = '$minuto3' where sn = '$sn'";
    mysqli_query($connect, $sql);
    echo "<div class='alert alert-dismissible alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Correcto!</strong><br>Se ha registrado correctamente.</div>";
  }
} else {
  echo "<div class='alert alert-dismissible alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Mal!</strong><br>Error</div>";
}

?>
