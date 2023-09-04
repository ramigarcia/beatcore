<!DOCTYPE html>
<html lang="es">
<!-- HEAD -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeatCore</title>
  <!-- CDN - BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- ESTILOS -->
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="../publico/css/modal.css">
  <!-- META PROPS -->
</head>

<body>
  <?php
  // HEADER
  include("../componentes/header.php");

  if (empty($_SESSION["usuario"])) {
    header("location: ../../");
  }

  if(isset($_GET["id_publicacion"])){

    ?>
    
    <form action="../controlador/publicar.php?id_publicacion=<?= $_GET["id_publicacion"]; ?>" method="POST">

        <label for="texto">

            <span>Texto</span>

            <input type="text" name="texto" id="texto" required autofocus>

        </label>

        <input type="submit" name="btn_responder" onsubmit="this.disabled=true;" value="Responder">

    </form>

    <?php

  }