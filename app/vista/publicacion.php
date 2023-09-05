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
  <!-- META PROPS -->
</head>

<body>
  <?php
  include("../componentes/header.php");

  if (empty($_SESSION["usuario"])) {
    header("location: ../../");
  }

  //   include("../componentes/sidebar.php");
  
  if (isset($_GET["id_publicacion"])) {

    include("../modelo/conexion.php");

    $id_publicacion = $_GET["id_publicacion"];

    $query = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario WHERE id_publicacion = '$id_publicacion' ORDER BY id_publicacion DESC";

    traerPublicaciones($query);

    ?>

    <h3>Nuevo comentario</h3>

    <form action="../controlador/comentar.php?id_publicacion=<?php echo $id_publicacion; ?>" method="POST">

      <label for="texto">

        <span></span>

        <input name="texto" id="texto" autofocus>

      </label>

      <input type="submit" name="btn_comentar" value="Comentar" onsubmit="this.disabled=true;">

    </form>

    <?php

    $query = "SELECT * FROM t_comentarios INNER JOIN t_usuarios ON t_comentarios.id_usuario = t_usuarios.id_usuario WHERE id_publicacion = '$id_publicacion' AND id_respuesta  IS NULL ORDER BY id_comentario DESC";

    mostrarComentarios($query);

  }else{

    header("Location: inicio.php");

  }

  ?>