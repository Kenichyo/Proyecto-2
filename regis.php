<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-1.12.3.min.js" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">

          <br><br>
          <h1><p class="text-center">Registro</p></h1>
          <br><br>

          <form method="post">

            <div class="form-group">
              <label for="id">id</label>
              <input type="text" name="id" id="id" class="form-control">
            </div>

            <div class="form-group">
              <label for="nombre">nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control">
            </div>

            <div class="form-group">
              <label for="apellido">apellido</label>
              <input type="text" name="apellido" id="apellido" class="form-control">
            </div>

            <div class="form-group">
              <label for="email">email</label>
              <input type="text" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
              <label for="pass">Contraseña</label>
              <input type="password" name="pass" id="pass" class="form-control">
            </div>

            <div class="form-group">
              <label for="rpass">Repetir contraseña</label>
              <input type="password" name="rpass" id="rpass" class="form-control">
            </div>

            <br><br>

            <div class="form-group">
              <input type="button" name="registrar" id="registrar" class="btn btn-success" value="Registrar">
            </div>

            <br><br>

            <span id="result"></span>

          </form>

        </div>
      </div>
    </div>

  </body>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    $('#registrar').click(function(){
      var id = $('#id').val();
      var nombre = $('#nombre').val();
      var apellido = $('#apellido').val();
      var email = $('#email').val();
      var pass = $('#pass').val();
      var rpass = $('#rpass').val();

      var expresion1 = /[a-z]/;
      var expresion2 = /\w/;
      if (id === "" || nombre === "" || apellido === "" || email === "" || pass === "" || rpass === "") {
        $("#result").html("<div class='alert alert-dismissible alert-danger'></button><strong>¡Error!</strong> Todos los campos son obligatorios.</div>");
        return false;
      }else if(isNaN(id) || id.length>9 || id.length<2){
        $("#result").html("<div class='alert alert-dismissible alert-danger'></button><strong>¡Error!</strong> El Rut debe ser valido y sin puntos ni guion.</div>");
        return false;
      }else if(pass != rpass || pass.length>12 || pass.length<4 || rpass.length>12 || rpass.length<4){
        $("#result").html("<div class='alert alert-dismissible alert-danger'></button><strong>¡Error!</strong> Las contraseñas: <br> -Deben ser las mismas. <br> -Deben tener entre 4 y 12 caracteres. </div>");
        return false;
      }
      if ($.trim(id).length > 0 && $.trim(nombre).length > 0 && $.trim(apellido).length > 0 && $.trim(email).length > 0 && $.trim(pass).length > 0 && $.trim(rpass).length > 0){
        $.ajax({
          url:'registrame.php',
          method:"POST",
          data:{id:id, nombre:nombre, apellido:apellido, email:email, pass:pass, rpass:rpass},
          cache:false,
          beforeSend:function(){
            $('#registrar').val("Comprobando información...");
          },
          success:function(data){
            $('#registrar').val("Registrar");
            if(data){
              $("#result").html(data);
            };
          }
        });
      };
    });
  });
</script>
