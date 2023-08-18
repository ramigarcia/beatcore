<!DOCTYPE html>
<html lang="en">
<!-- HEAD -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeatCore</title>
  <!-- CDN - BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- ESTILOS -->
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/guardado.css">
  <!-- META PROPS -->
</head>

<body>
  <?php
  include("../componentes/header.php");

  if (empty($_SESSION["usuario"])) {
    header("location: ../../");
  } ?>
  <div class="wrapper">
    <?php
    include("../componentes/sidebar.php");

    $id_usuario = $_SESSION["id_usuario"];

    ?>
    <div class="publicaciones_guardadas">
      <h3>Publicaciones guardadas</h3>
      <?php

      $query = "SELECT * FROM t_publicaciones INNER JOIN t_guardados ON t_publicaciones.id_publicacion = t_guardados.id_publicacion INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario WHERE t_guardados.id_usuario = '$id_usuario' ORDER BY t_publicaciones.id_publicacion DESC";
      ?>
      <main>
        <?php traerPublicaciones($query); ?>
      </main>
    </div>
  </div>