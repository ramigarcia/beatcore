<!DOCTYPE html>
<html lang="en">
<!-- HEAD -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeatCore</title>
  <!-- CDN - BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Nunito:wght@200;300;500&display=swap"
    rel="stylesheet">
  <!-- ESTILOS -->
  <link rel="stylesheet" href="../css/main.css">
  <!-- META PROPS -->
</head>

<body>
  <?php
  include("../componentes/header.php");

  if (empty($_SESSION["usuario"])) {
    header("location: ../../");
  }

  // include("../componentes/sidebar.php");
  
  if (isset($_GET["id_comentario"])) {

    include("../modelo/conexion.php");

    $id_comentario = $_GET["id_comentario"];

    $comentario_p = datosComentario($id_comentario);

    $id_comentario = $comentario_p["id_comentario"];

    $id_publicacion = $comentario_p["id_publicacion"];

    // MOSTRAR PUBLICACION
    $query = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario WHERE id_publicacion = '$id_publicacion' ORDER BY id_publicacion DESC";

    traerPublicaciones($query);

    // MOSTRAR COMENTARIO A RESPONDER
    $query = "SELECT * FROM t_comentarios INNER JOIN t_usuarios ON t_comentarios.id_usuario = t_usuarios.id_usuario WHERE id_comentario = '$id_comentario'";

    mostrarComentarios($query);

    ?>

    <h3>Responder comentario</h3>

    <form
      action="../controlador/comentar.php?id_publicacion=<?= $comentario_p["id_publicacion"] ?>&id_respuesta=<?= $comentario_p["id_comentario"] ?>"
      method="POST">

      <label for="texto">

        <span>Texto</span>

        <input name="texto" id="texto" autofocus required>

      </label>

      <input type="submit" name="btn_comentar" value="Comentar" onsubmit="this.disabled=true;">

    </form>

    <?php

    $query = "SELECT * FROM t_comentarios INNER JOIN t_usuarios ON t_comentarios.id_usuario = t_usuarios.id_usuario WHERE id_respuesta = '$id_comentario' ORDER BY id_comentario DESC";

    mostrarComentarios($query);

  }

  ?>