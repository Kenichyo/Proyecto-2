<?php 

session_start();

$connect = mysqli_connect("localhost", "root", "smartdawn", "proyectosmart");

//Ingresar Adaptador
if(isset($_POST["sn"])){
  $sn1 = mysqli_real_escape_string($connect, $_POST["sn"]);
  $id1 = mysqli_real_escape_string($connect, $_SESSION['id']);
  $result1 = "";

//Validar Adaptador Existente
$sql1 = "SELECT COUNT(*) as cantidad FROM adaptador WHERE sn='$sn1'";
    $res1 = mysqli_query($connect, $sql1);
    $data1 = mysqli_fetch_array($res1);
    if ($data1["cantidad"] > 0) {
      $result1 = "El numero de serie ya esta registrado.";
    }

//Insertar SN Adaptador
if ($result1 != "") {
    echo "<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>$result1</div>";
  }else{
    $sql1 = "INSERT INTO adaptador VALUES($sn1, $id1, null	, null, null, null, null, null)";
    mysqli_query($connect, $sql1);
    echo "<div class='alert alert-dismissible alert-success'><strong>¡Correcto!</strong><br>Se ha registrado el adaptador correctamente.</div>";
  }

    
  }

//Ingresar Dispensador
if(isset($_POST["sn2"])){
  $sn2 = mysqli_real_escape_string($connect, $_POST["sn2"]);
  $id2 = mysqli_real_escape_string($connect, $_SESSION["id"]);
  $result2 = "";

//Validar Dispensador Existente
  $sql2 = "SELECT COUNT(*) as cantidad FROM dispensador WHERE sn='$sn2'";
    $res2 = mysqli_query($connect, $sql2);
    $data2 = mysqli_fetch_array($res2);
    if ($data2["cantidad"] > 0) {
      $result2 = "<br>El numero de serie ya esta registrado.";
    }

//Insertar SN Dispensador
if ($result2 != "") {
    echo "<div class='alert alert-dismissible alert-danger'></button><strong>¡Error!</strong>$result2</div>";
  } else {
    $sql2 = "INSERT INTO dispensador VALUES($sn2, $id2, null, null, null, null, null, null)";
    mysqli_query($connect, $sql2);
    echo "<div class='alert alert-dismissible alert-success'></button><strong>¡Correcto!</strong><br>Se ha registrado el Dispensador correctamente.</div>";
  }}

//Cambio de contraseña
 if(isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["email"]) && isset($_POST["pass1"]) && isset($_POST["pass2"])){
  $id3 = mysqli_real_escape_string($connect, $_POST["id"]);
  $nombre3 = mysqli_real_escape_string($connect, $_POST["nombre"]);
  $apellido3 = mysqli_real_escape_string($connect, $_POST["apellido"]);
  $email3 = mysqli_real_escape_string($connect, $_POST["email"]);
  $pass1 = mysqli_real_escape_string($connect, $_POST["pass1"]);
  $pass2 = mysqli_real_escape_string($connect, $_POST["pass2"]);
  $result3 = "";

if ($result3 != "") {
    echo "<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error</strong><br>$result3</div>";
  } else {
        $sql3 = "UPDATE usuario SET nombre = '$nombre3', apellido = '$apellido3', email = '$email3', pass = '$pass2' where id = '$id3'";
        mysqli_query($connect, $sql3);
        echo "<div class='alert alert-dismissible alert-success'><strong>¡Correcto!</strong><br>Su perfil ha sido actualizado correctamente.</div>";
  
    }
    }
 ?>