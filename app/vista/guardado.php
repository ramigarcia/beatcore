<!DOCTYPE html>
<html lang="en">
<!-- HEAD -->
<?php
include("../componentes/head.php");
?>

<body>
  <?php
  include("../componentes/header.php");

  if (empty($_SESSION["usuario"])) {
    header("location: ../../");
  }

  include("../componentes/sidebar.php");

  $id_usuario = $_SESSION["id_usuario"];

  ?><h3>Publicaciones guardadas</h3><?php

  $query = "SELECT * FROM t_publicaciones INNER JOIN t_guardados ON t_publicaciones.id_publicacion = t_guardados.id_publicacion INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario WHERE t_guardados.id_usuario = '$id_usuario' ORDER BY t_publicaciones.id_publicacion DESC";

  traerPublicaciones($query);