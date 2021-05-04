<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://img.icons8.com/officel/16/000000/bus2.png"/>
    <title>Login</title>
    <!--Fuente-->
    <link rel = "preconnect" href = "https://fonts.gstatic.com">
    <link href = "https://fonts.googleapis.com/css2? family = Courier + Prime: wght @ 700 & display = intercambiar "rel =" hoja de estilo ">

    <!--Jquery para pestaña-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 
    <!--Carpeta css-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/css/all.min.css">


</head>
<?php
session_start();
if(!empty($_SESSION['us_tipo']))
{
    header('Location: controlador/LoginControler.php');

}
else{
session_destroy();


?>


<body>
    <!--Imagen fondo -->
    <img class="fondo" src="img/Noche.png">
    <div class="contenedor">
      
        <div class="img">
            <!--Imagen dos personas y su equipaje------------------------------------------------>
           <img src="" alt="">
        </div>
  
        <div class="contenido-login">
            <form action="controlador/LoginControler.php" method="POST">
                <!--Logo-->
                <img src="img/logo_sizesin.png" alt="">
         
              <!------------Usuario------------------------->
                <div class="input-div usuario">
                    <div class="i">
                        <!--icono de usuario-->
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input type="text" name="user" class="input" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <!--icono candado-->
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input  ID="txtPassword"  type="password" name="pass" class="input" required> 
                        <div class="input-group-append">
                        <button id="show_password" class="btn btn-primary " type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> 
                        </button>
                            
                        </div>
                            
                    </div>
                   
                </div>
                <a href="vista/recuperar.php">¿Olvidaste tu contraseña?</a>
                <input type="submit" class="sesion" value="Iniciar sesion">
            </form>
        </div>
    </div>
</body>

<script src="js/login.js"></script>

   <script type="text/javascript">
            function mostrarPassword(){
                    var cambio = document.getElementById("txtPassword");
                    if(cambio.type == "password"){
                        cambio.type = "text";
                        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                    }else{
                        cambio.type = "password";
                        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                    }
                } 
                
                $(document).ready(function () {
                //CheckBox mostrar contraseña
                $('#ShowPassword').click(function () {
                    $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
                });
            });
    </script>
 
</html>

<?php
}
?>