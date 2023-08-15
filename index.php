<!DOCTYPE html>
<html lang="en">
<?php include("app/componentes/head.php"); ?>

<body>
  <header>
    <a href="index.php">BeatCore</a>

    <a href="login.php">Iniciar Sesión</a>

    <a href="registro.php">Registrarse</a>
  </header>
  <?php
  session_start();

  if (isset($_SESSION["usuario"])) {
    header("location: app/vista/inicio.php");
  }
  ?>
  <h1>BeatCore - Landing page</h1>

  <p>La primer red social para Beatboxers</p>

  <p>
    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam laudantium illum earum ex est possimus sint
    voluptatem mollitia modi quo, dolorum velit perferendis quod, quas beatae at accusantium tenetur tempore.
  </p>

</body>

</html>