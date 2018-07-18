<?php 

include "header.php";

 ?>
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Guarda</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-1.12.3.min.js" charset="utf-8"></script>
  </head>
  <style type="text/css" media="screen">
  body {
    background-image: url("image/image1.jpg");
}
 </style>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <br><br>
          <h1><p class="text-center">Registre Adaptador</p></h1>
          <br><br>
          <form method="post">
            <div class="form-group">
              <label for="sn">Numero de Serie: </label>
              <input type="text" name="sn" id="sn" class="form-control">
            </div>
            <br><br>
            <div class="form-group">
              <input type="button" name="guardar" id="guardar" class="btn btn-success" value="Registrar">
            </div>
            <br><br>
            <span id="result"></span>
          </form>
        </div>
        <div class="col-sm-6"> 
        <br><br>
          <h1><p class="text-center">Registre Dispensador</p></h1>
          <br><br>
          <form method="post">
            <div class="form-group">
              <label for="sn2">Numero de Serie</label>
              <input type="text" name="sn2" id="sn2" class="form-control">
            </div>
            <br><br>
            <div class="form-group">
              <input type="button" name="guardar2" id="guardar2" class="btn btn-success" value="Registrar">
            </div>
            <br><br>
            <span id="result2"></span>
          </form>         
        </div>
      </div>
    </div>
  </body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    $('#guardar').click(function(){
      var sn = $('#sn').val();
      if (sn === "") {
      	$("#result").html("<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>-Debe Ingresar un Numero de Serie</div>");
      }
      else if (sn.length > 8 || sn.length < 8 || isNaN(sn)) {
      	$("#result").html("<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>-Debe ingresar solo Números. <br> -Los Numeros de Serie son de 8 digitos.</div>");
      }
      else if ($.trim(sn).length > 0){
        $.ajax({
          url:'indexame.php',
          method:"POST",
          data:{sn:sn},
          cache:false,
          beforeSend:function(){
            $('#guardar').val("Comprobando información...");
          },
          success:function(data){
            
            $('#guardar').val("Registrar");
            if(data){
              $("#result").html(data);
            };

          }
        });
      };
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#guardar2').click(function(){
      var sn2 = $('#sn2').val();
      if (sn2 === "") {
      	$("#result2").html("<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>-Debe Ingresar un Numero de Serie</div>");
      }
      else if (sn2.length > 8 || sn2.length < 8 || isNaN(sn2)) {
      	$("#result2").html("<div class='alert alert-dismissible alert-danger'><strong>¡Error!</strong><br>-Debe ingresar solo Números. <br> -Los Numeros de Serie son de 8 digitos.</div>");
      }
      else if ($.trim(sn2).length > 0){
        $.ajax({
          url:'indexame.php',
          method:"POST",
          data:{sn2:sn2},
          cache:false,
          beforeSend:function(){
            $('#guardar2').val("Comprobando información...");
          },
          success:function(data){
            
            $('#guardar2').val("Registrar");
            if(data){
              $("#result2").html(data);
            };

          }
        });
      };
    });
  });
</script>