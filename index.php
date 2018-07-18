<?php

session_start();
if(!isset($_SESSION["id"])){
  header("location:login.php");
}

$connect = mysqli_connect("localhost", "root", "smartdawn", "proyectosmart");
$id = mysqli_real_escape_string($connect, $_SESSION['id']);
$sql = "SELECT * FROM usuario WHERE id = '$id'";
  $resultado = mysqli_query($connect, $sql);;
  if (!$resultado) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
  }else{
    $fila = mysqli_fetch_row($resultado);
  }

echo '<b> <h1 class="" align=center>Bienvenido: '.$fila[1].'</h1> </b>';

include "header.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-1.12.3.min.js" charset="utf-8"></script>
    <style type="text/css" media="screen">
      body{
        background-image: url('image/image1.jpg');
      }
    </style>
</head>
<body>
  <form method="POST">
  <div class="container">
    <div class="row">

      <div class="col-2">
        
      </div>
      <div class="col-4">

        <b>Rut</b>
        <input class="form-control" type="text" name="id" id="id" disabled value="<?php echo $fila[0]; ?>"> <br>        
        <b>Apellido</b>
        <input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo $fila[2]; ?>"> <br>        
        <b>Antigua Contraseña</b>
        <input class="form-control" type="password" name="pass1" id="pass1"> <br>
        
        <br>
        <input class="btn btn-success" type="button" name="cambiar" id="cambiar" value="Actualizar Perfil">
      </div>
      <div class="col-4">
        <b>Nombre</b>
        <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $fila[1]; ?>"> <br>
        <b>Correo</b>
        <input class="form-control" type="text" name="email" id="email" value="<?php echo $fila[4]; ?>"> <br>   
        <b>Nueva Contraseña</b>
        <input class="form-control" type="password" name="pass2" id="pass2"> <br>
        <span id="result"></span> <br>
        <input class="form-control" hidden="true" type="password" name="pass" id="pass" value="<?php echo $fila[3]; ?>">
      </div>
      <div class="col-2">
      
      </div>
    </div>
  </div>
  
  </form>
</body>
</html>
<script type="text/javascript">
   $(document).ready(function(){
    $('#cambiar').click(function(){
      var id = $('#id').val();
      var nombre = $('#nombre').val();
      var apellido = $('#apellido').val();
      var email = $('#email').val();
      var pass0 = $('#pass').val();
      var pass1 = $('#pass1').val();
      var pass2 = $('#pass2').val();
      if (nombre === "" || apellido === "" || email === "" || pass1 === "" || pass2 === "") {
        $("#result").html("<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>-No puede dejar campos vacios.</div>");
          return false;
      }else if (pass1 != pass0) {
        $("#result").html("<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>-Contraseña actual erronea.</div>");
          return false;
      }

      else if ($.trim(id).length > 0 && $.trim(nombre).length > 0 && $.trim(apellido).length > 0 && $.trim(email).length > 0 && $.trim(pass1).length > 0 && $.trim(pass2).length > 0){
        $.ajax({
          url:'indexame.php',
          method:"POST",
          data:{id:id, nombre:nombre, apellido:apellido, email:email, pass1:pass1, pass2:pass2},
          cache:false,
          beforeSend:function(){
            $('#cambiar').val("Comprobando información...");
          },
          success:function(data){
            $('#cambiar').val("Actualizar Perfil");
            if(data){
              $("#result").html(data);
            };

          }
        });
      };
    });
  });
 </script>