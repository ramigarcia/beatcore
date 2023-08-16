<!DOCTYPE html>
<html lang="en">
<!-- HEAD -->
<?php 
include("../componentes/head.php");
include("../ayudas/funciones.php");
?>

<body>
  <?php
  include("../componentes/header.php");

  if (empty($_SESSION["usuario"])) {
    header("location: ../../");
  }

  include("../componentes/sidebar.php");

  ?><h2>Publicaciones</h2><?php

  $query = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario ORDER BY id_publicacion DESC";

  traerPublicaciones($query);
  ?>
</body>

</html>