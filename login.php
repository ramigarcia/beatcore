<?php
require("app/modelo/conexion.php");
function mostrarSiExiste($name)
{
  if (isset($_POST["$name"])) {
    echo $_POST["$name"];
  }
}

session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeatCore</title>
  <!-- CDN BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- ESTILOS -->
  <link rel="stylesheet" href="./css/main.css">
  <!-- META PROPS -->
</head>

<body>
  <header>
    <nav class="navigation">
      <div class="logo">
        <a href="index.php">BeatCore</a>
      </div>
      <ul class="navigation-list">
        <li class="navigation-list-item">
          <a href="login.php">Iniciar Sesión</a>
        </li>
        <li class="navigation-list-item">
          <a href="registro.php">Registrarse</a>
        </li>
      </ul>
    </nav>
  </header>

  <!-- FORMULARIO -->
  <div class="container">
    <form action="login.php" method="POST">
      <legend>Iniciar Sesion</legend>
      <!-- MENSAJE DE "FELICIDADES, TE REGISTRASTE" -->

      <?php

      if (isset($_SESSION["msj"])) {

        echo $_SESSION["msj"];

        unset($_SESSION["msj"]);

      }

      ?>

      <!-- FIN DEL MENSAJE -->
      <label for="usuario">
        <span>Nombre de usuario</span>
        <input type="text" value="<?php mostrarSiExiste("usuario"); ?>" name="usuario" id="usuario"
         autofocus>
      </label>
      <label for="clave">
        <span>Contraseña</span>
        <input type="password" name="clave" id="clave" required>
      </label>
      <button name="btn_login">Iniciar sesión</button>
    </form>
  </div>
</body>

</html>
<?php
if (isset($_SESSION["usuario"])) {

  header("location: app/vista/inicio.php");

}
if (isset($_POST["btn_login"])) {

  $stmt = mysqli_prepare($con, "SELECT id_usuario, usuario, clave, id_rol FROM t_usuarios WHERE usuario = ?");

  mysqli_stmt_bind_param($stmt, "s", $_POST["usuario"]);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $id_usuario, $usuario, $clave, $id_rol);
  
  if (mysqli_stmt_fetch($stmt) == NULL) {
    echo "Usuario incorrecto";
  } else {

    if ($_POST["clave"] != $clave) {
      echo "Contraseña incorrecta";
    } else {

      $_SESSION["usuario"] = $usuario;

      $_SESSION["id_usuario"] = $id_usuario;

      $_SESSION["id_rol"] = $id_rol;

      header("location: app/vista/inicio.php");

    
    }
  }
}