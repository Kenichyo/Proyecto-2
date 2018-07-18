<?php

session_start();
$connect = mysqli_connect("localhost","root","smartdawn","proyectosmart");

if(isset($_POST["id"]) && isset($_POST["pass"])){
  $id = mysqli_real_escape_string($connect, $_POST["id"]);
  $pass = mysqli_real_escape_string($connect, $_POST["pass"]);
  $sql = "SELECT id FROM usuario WHERE id = '$id' AND pass='$pass'";
  $result = "";
  if (empty($_POST["id"]) || empty($_POST["pass"])) {
    $result = 'Error';
  }else{
    $result = mysqli_query($connect, $sql);
    $num_row = mysqli_num_rows($result);
    if ($num_row == "1") {
      $data = mysqli_fetch_array($result);
      $_SESSION["id"] = $data["id"];
      echo "1";
  }
  }



  
}



?>
