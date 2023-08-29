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
  <div class="overlay"></div>
  <header>
    <nav class="navigation">
      <div class="menu">
        <i class='bx bx-menu'></i>
      </div>
      <div class="cerrar-menu">
        <i class='bx bx-x' ></i>
      </div>
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

    <div class="hero">
      <h1>BeatCore - Landing page</h1>
    </div>

  </header>
  <?php
  session_start();

  if (isset($_SESSION["usuario"])) {
    header("location: app/vista/inicio.php");
  }
  ?>

  <p>La primer red social para Beatboxers</p>

  <p>
    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam laudantium illum earum ex est possimus sint
    voluptatem mollitia modi quo, dolorum velit perferendis quod, quas beatae at accusantium tenetur tempore.
  </p>

</body>

</html>