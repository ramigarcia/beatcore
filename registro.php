<?php require("app/modelo/conexion.php"); ?>

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
  <?php
  function mostrarSiExiste($name)
  {
    if (isset($_POST["$name"])) {
      echo $_POST["$name"];
    }
  }
  session_start();
  ?>
  <!-- FORMULARIO -->
  <div class="container">
    <form action="registro.php" method="POST">
      <legend>Registrar usuario</legend>
      <label for="usuario">
        <span>Usuario</span>
        <input type="text" value="<?php mostrarSiExiste("usuario"); ?>" name="usuario" id="usuario" required autofocus>
      </label>

      <label for="gmail">
        <span>Gmail</span>
        <input type="email" value="<?php mostrarSiExiste("gmail"); ?>" name="gmail" id="gmail" required>
      </label>

      <label for="fecha_nacimiento">
        <span>Fecha de nacimiento</span>
        <input type="date" value="<?php mostrarSiExiste("fecha_nacimiento"); ?>" name="fecha_nacimiento"
          id="fecha_nacimiento" required>
      </label>

      <label for="clave">
        <span>Contraseña</span>
        <input type="password" name="clave" id="clave" required>
      </label>

      <label for="rep_clave">
        <span>Repetir contraseña</span>
        <input type="password" name="rep_clave" id="rep_clave" required>
      </label>

      <label for="terminos_condiciones" class="terminos">
        <input type="checkbox" name="terminos_condiciones" id="terminos_condiciones" value="1" required>
        <span>Acepto los términos y <a href="#">condiciones</a></span>
      </label>

      <button type="submit" name="btn_registrar_usuario">Registrarse</button>
    </form>
  </div>

</body>

</html>

<?php
if (isset($_SESSION["usuario"])) {

  header("location: vista/inicio.php");

}

if (isset($_POST["btn_registrar_usuario"])) {

  // OBTENGO LOS DATOS DEL FORMULARIO

  $usuario = $_POST["usuario"];
  $gmail = $_POST["gmail"];
  $fecha_nacimiento = $_POST["fecha_nacimiento"];
  $clave = md5($_POST["clave"]);
  $rep_clave = md5($_POST["rep_clave"]);
  $foto_perfil = "../../publico/img/foto_perfil/por_defecto.png";
  $foto_portada = "../../publico/img/foto_portada/por_defecto.png";

  // VALIDACIÓN DE LOS CAMPOS
  $query = "SELECT usuario FROM t_usuarios WHERE usuario = '$usuario'";

  $res = mysqli_query($con, $query);

  if (mysqli_num_rows($res) > 0) {
    echo "Nombre de usuario en uso, escoja otro";
  } else {
    $query = "SELECT gmail FROM t_usuarios WHERE gmail = '$gmail'";
    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) > 0) {
      echo "El gmail ya está en uso, escoja otro";
    } else {

      if ($clave != $rep_clave) {
        echo "Las contraseñas no coinciden";
      } else {

        // REGISTRAR USUARIO
        $query = "INSERT INTO t_usuarios(usuario, gmail, fecha_nacimiento, clave, foto_portada, foto_perfil, id_rol, fecha_creacion) VALUES('$usuario', '$gmail','$fecha_nacimiento', '$clave', '$foto_portada', '$foto_perfil', '1', now())";

        $res = mysqli_query($con, $query);

        if ($res) {
          $_SESSION["msj"] = "Felicidades, se registró exitosamente";
          header("Location: login.php");
        } else {
          echo "Algo salió mal";
        }
      }
    }
  }
}