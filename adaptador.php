<?php 
include 'header.php';

session_start();
$connect = mysqli_connect("localhost", "root", "smartdawn", "proyectosmart");
$id = mysqli_real_escape_string($connect, $_SESSION['id']);
$sql1 = "SELECT hora1, minuto1, hora2, minuto2, hora3, minuto3 FROM adaptador WHERE id_user = '$id'";
$resultado1 = mysqli_query($connect, $sql1);
  if (!$resultado1) {
    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
    exit;
  }else{
    $fila = mysqli_fetch_row($resultado1);
  }


 ?>
 <!DOCTYPE html>
 <html>
 <head>
    <meta charset="utf-8">
    <title>Adaptador</title>
        <script src="js/jquery-1.12.3.min.js" charset="utf-8"></script>
 </head>
 <style type="text/css">
   body {
    background-image: url("image/imageA4.jpg");
   }
   p {
    font-family: "Lucida Console", Times, serif;
   }
   b {
    font-family: "Lucida Console", Times, serif;
   }
   </style>
 <body>
 	<div class="container">
 		<div class="row">
 			<div class="col-sm-2">
 				
 			</div>
 			<div class="col-sm-8" id="jumbotron" align="center">
 				<form method="POST">
          <div class="container">
            <div class="row">
              <div class="col-3">
                
              </div>
              <div class="col-6  form-control">
                <b>Hora del Café 1: </b><br> <input type="number" name="hora1" id="hora1" min="0" max="23" value="<?php echo $fila[0]; ?>" class="btn btn-success" >:<input type="number" min="0" max="59" id="minuto1" name="minuto1" value="<?php echo $fila[1]; ?>" class="btn btn-success" >
                <br> <br>
                <b>Hora del Café 2: </b><br> <input type="number" name="hora2" id="hora2" min="0" max="23" value="<?php echo $fila[2]; ?>" class="btn btn-success" >:<input type="number" min="0" max="59" name="minuto2" id="minuto2" value="<?php echo $fila[3]; ?>" class="btn btn-success" >
                <br> <br>
                <b>Hora del Café 3: </b><br> <input type="number" name="hora3" id="hora3" min="0" max="23" value="<?php echo $fila[4]; ?>" class="btn btn-success" >:<input type="number" min="0" max="59" name="minuto3" id="minuto3" value="<?php echo $fila[5]; ?>" class="btn btn-success" >
                <br> <br>
                <input type="submit" class="btn btn-success" name="encenderA" id="encenderA" value="Encender">
                <br> <br>
              </div>

            </div>
            <br>
            <span id="result"></span>
          </div>
					
          <br> <br>
          <span id="result"></span>
				</form>
 			</div>
 			<div class="col-2">
 				
 			</div>
 		</div>
 	</div>
 
 </body>
 </html>

 <script type="text/javascript">
  $(document).ready(function(){
   $('#encenderA').click(function(){
        var hora1 = $('#hora1').val();
        var minuto1 = $('#minuto1').val();
        var hora2 = $('#hora2').val();
        var minuto2 = $('#minuto2').val();
        var hora3 = $('#hora3').val();
        var minuto3 = $('#minuto3').val();
        if (hora1 === "" || minuto1 === "" || hora2 === "" || minuto2 === "" || hora3 === "" || minuto3 === "") {
          $("#result").html("<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>-Primero debe inscribir su Adaptador.</div>");
          return false;
        }
        else if (hora1 >= 24 || minuto1 >= 60 || hora2 >= 24 || minuto2 >= 60 || hora3 >= 24 || minuto3 >= 60){
            $("#result").html("<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>-Las horas y minutos deben ser validos.</div>");
            return false;
        }else{
          if ($.trim(hora1).length > 0 && $.trim(minuto1).length > 0 && $.trim(hora2).length > 0 && $.trim(minuto2).length > 0 && $.trim(hora3).length > 0 && $.trim(minuto3).length > 0){
            $.ajax({
              url:'adaptadorme.php',
              method:"POST",
              data:{hora1:hora1, minuto1:minuto1, hora2:hora2, minuto2:minuto2, hora3:hora3, minuto3:minuto3},
              cache:false,
              beforeSend:function(){
              $('#encenderA').val("Comprobando información...");
              },
                success:function(data){
                $('#encenderA').val("Encender");
                if(data){
                  $("#result").html(data);
                };
              }
            });
          };
        }
    });
}); 
   
 </script>