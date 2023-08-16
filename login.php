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
<html lang="en">
<?php include("app/componentes/head.php"); ?>

<body>
  <header>
    <a href="index.php">BeatCore</a>

    <a href="login.php">Iniciar Sesión</a>

    <a href="registro.php">Registrarse</a>
  </header>
  <h1>Iniciar sesión</h1>

  <!-- MENSAJE DE "FELICIDADES, TE REGISTRASTE" -->

    <?php
    
      if(isset($_SESSION["msj"])){

        echo $_SESSION["msj"];

        unset($_SESSION["msj"]);

      }
    
    ?>

  <!-- FIN DEL MENSAJE -->
  
  <!-- FORMULARIO -->
  <form action="login.php" method="POST">
    <label for="usuario">
      <span>Nombre de usuario</span>
      <input type="text" value="<?php mostrarSiExiste("usuario"); ?>" name="usuario" id="usuario"
        pattern="[A-Za-z]{3,20}" required autofocus>
    </label>
    <label for="clave">
      <span>Contraseña</span>
      <input type="password" name="clave" id="clave" required>
    </label>
    <button name="btn_login">Iniciar sesión</button>
  </form>
</body>

</html>
<?php
if(isset($_SESSION["usuario"])){

header("location: app/vista/inicio.php");

}
if (isset($_POST["btn_login"])) {
  $usuario = $_POST["usuario"];

  $clave = md5($_POST["clave"]);

  $query = "SELECT * FROM t_usuarios WHERE usuario = '$usuario'";

  $res = mysqli_query($con, $query);

  if (mysqli_num_rows($res) == 0) {
    echo "Usuario incorrecto";
  } else {

    $query = "SELECT * FROM t_usuarios WHERE usuario = '$usuario' AND clave = '$clave'";

    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) == 0) {
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