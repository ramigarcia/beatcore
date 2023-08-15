<!DOCTYPE html>
<html lang="en">
<!-- HEAD -->
<?php include("../componentes/head.php"); ?>

<body>
  <?php
  include("../componentes/header_vista_usuario.php");

  if (empty($_SESSION["usuario"])) {
    header("location: ../../");
  }

  include("../componentes/sidebar.php");

  $query = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario";

  traerPublicaciones($query);
  ?>
</body>

</html>