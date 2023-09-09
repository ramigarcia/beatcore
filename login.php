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
          required autofocus>
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
  $usuario = $_POST["usuario"];

  $clave = md5($_POST["clave"]);

  $query = "SELECT * FROM t_usuarios WHERE usuario = '$usuario'";

  $res = mysqli_fetch_array(mysqli_query($con, $query));
  
  if (empty($res)) {
    echo "Usuario incorrecto";
  } else {

    if (!password_verify($_POST["clave"], $res["clave"])) {
      echo "Contraseña incorrecta";
    } else {

      while ($fila = mysqli_fetch_array($res)) {

        $_SESSION["usuario"] = $fila["usuario"];

        $_SESSION["id_usuario"] = $fila["id_usuario"];

        header("location: app/vista/inicio.php");

      }
    }
  }
}