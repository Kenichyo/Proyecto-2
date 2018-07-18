<?php 
include 'header.php';

session_start();
$connect = mysqli_connect("localhost", "root", "smartdawn", "proyectosmart");
$id = mysqli_real_escape_string($connect, $_SESSION['id']);
$sql1 = "SELECT hora1, minuto1, cantidad1, hora2, minuto2, cantidad2 FROM dispensador WHERE id_user = '$id'";
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
 	<title>Dispensador</title>
 	    <script src="js/jquery-1.12.3.min.js" charset="utf-8"></script>
 </head>
 <style type="text/css">
 	body {
    background-image: url("image/image3.jpg");
	}
	b {
    font-family: "Lucida Console", Times, serif;
   }
 </style>
 <body>
 	<div class="container">
 		<div class="row">
 			<div class="col-4" >
 				<form method="POST">
 					<b>Seleccione las horas de comida:</b> <br>
 					<div class="form-control">
 						<b>Hora de la 1ra Comida: </b> <br> <input type="number" name="hora1" id='hora1' min='0' max="23" value="<?php echo $fila[0]; ?>" class="btn btn-success" >:<input type="number" name='minuto1' id='minuto1' min='0' max="59" value="<?php echo $fila[1]; ?>" class="btn btn-success">
						<br> <br>
						<b>Cantidad de la 1ra Comida: </b> <br>
						<input type="number" class="btn btn-success" id="cantidad1" min="100" max="900" name="cantidad1" value="<?php echo $fila[2]; ?>">	
 					</div>
					<br>
					<div class="form-control">
 						<b>Hora de la 2da Comida: </b> <br> <input type="number" name="hora2" id='hora2' min='0' max="23" class="btn btn-success" value="<?php echo $fila[3]; ?>">:<input type="number" name="minuto2" id='minuto2' min='0' max="59" class="btn btn-success" value="<?php echo $fila[4]; ?>">
						<br> <br>
						<b>Cantidad de la 2da Comida: </b> <br>
						<input type="number" id="cantidad2" class="btn btn-success" min="100" max="900" name="cantidad2" value="<?php echo $fila[5]; ?>">	
 					</div>
					<br>
					<input type="submit" class="btn btn-success" name="encenderB" id="encenderB" value="Encender">
					<br> <br>
					<span id="result"></span>
				</form>
 			</div>
 			<div class="col-7">
 				<img src="image/imageB2.jpg">
 			</div>
 		</div>
 	</div>
 
 </body>
 </html>
 <script type="text/javascript">
   $(document).ready(function(){
    $('#encenderB').click(function(){
      var hora1 = $('#hora1').val();
      var minuto1 = $('#minuto1').val();
      var cantidad1 = $('#cantidad1').val();
      var hora2 = $('#hora2').val();
      var minuto2 = $('#minuto2').val();
      var cantidad2 = $('#cantidad2').val();
      if (hora1 === "" || minuto1 === "" || cantidad1 === "" || hora2 === "" || minuto2 === "" || cantidad2 === "") {
          $("#result").html("<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>-Primero debe inscribir su Dispensador.</div>");
          return false;
        }
      else if (hora1 >= 24 || minuto1 >= 60 || cantidad1 > 900 || hora2 >= 24 || minuto2 >= 60 || cantidad2 > 900){
            $("#result").html("<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>-La hora y cantidad deben ser validos.</div>");
            return false;
        }else{
      		if ($.trim(hora1).length > 0 && $.trim(minuto1).length > 0 && $.trim(cantidad1).length > 0 && $.trim(hora2).length > 0 && $.trim(minuto2).length > 0 && $.trim(cantidad2).length > 0){
        		$.ajax({
          		url:'dispensadorme.php',
          		method:"POST",
          		data:{hora1:hora1, minuto1:minuto1, cantidad1:cantidad1, hora2:hora2, minuto2:minuto2, cantidad2:cantidad2},
          		cache:false,
          		beforeSend:function(){
        		$('#encenderB').val("Comprobando información...");
         	 	},
          			success:function(data){
            		$('#encenderB').val("Encender");
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