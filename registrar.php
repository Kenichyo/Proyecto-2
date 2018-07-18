<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-1.12.3.min.js" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  </head>
  <body>
<style type="text/css" media="screen">
  body {
    background-image: url("image/image3.jpg");
}
 </style>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-offset-3">
          <br> <br>
          <h1><p class="">Registro</p></h1>
          <form method="post">
            <div class="form-group fa fa-id-card">
              <label for="id">Rut</label>
              <input type="text" name="id" id="id" class="form-control">
            </div>
            <div class="form-group fa fa-user-circle">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control">
            </div>
            <div class="form-group fa fa-user-circle">
              <label for="apellido">Apellido</label>
              <input type="text" name="apellido" id="apellido" class="form-control">
            </div>
            <div class="form-group fa fa-envelope-square">
              <label for="email">Correo</label>
              <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="form-group fa fa-key">
              <label for="pass">Contraseña</label>
              <input type="password" name="pass" id="pass" class="form-control">
            </div>
            <div class="form-group fa fa-key">
              <label for="rpass">Repita Contraseña</label>
              <input type="password" name="rpass" id="rpass" class="form-control">
            </div>
            <br>
            <div class="form-group fa">
              <button class="btn btn-success" id="registrar"><i class="fa fa-sign-in-alt"></i>Registrar</button>
              <br> <br>
              <p> ¿Ya tienes cuenta? Ingresa <a href="login.php" title="">aquí </a>  </p>
              <br> <br>
            </div>
            <span id="result"></span>
          </form>
        </div>
        <div id="div" class="col-sm-8">
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
      }else if(pass != rpass){
        $("#result").html("<div class='alert alert-dismissible alert-danger'></button><strong>¡Error!</strong> <br>Las contraseñas deben ser las mismas.</div>");
        return false;
      }else if (pass.length>12 || pass.length<4 || rpass.length>12 || rpass.length<4) {
        $("#result").html("<div class='alert alert-dismissible alert-danger'></button><strong>¡Error!</strong> <br> Las contraseñas deben tener entre 4 y 12 caracteres. </div>");
        return false;
      }else if(!expresion1.test(nombre)){
        $("#result").html("<div class='alert alert-dismissible alert-danger'></button><strong>¡Error!</strong> <br> Ingrese un Nombre Valido. </div>");
        return false;
      }else if (!expresion1.test(apellido)) {
        $("#result").html("<div class='alert alert-dismissible alert-danger'></button><strong>¡Error!</strong> <br> Ingrese un Apellido Valido. </div>");
        return false;
      }else if (!expresion2.test(email)) {
        $("#result").html("<div class='alert alert-dismissible alert-danger'></button><strong>¡Error!</strong> <br> Ingrese un Correo Valido. </div>");
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
