<!DOCTYPE html>
<html lang="en">

<?php include("../componentes/head.php"); ?>

<body>
  <?php
  include("../componentes/header_vista_usuario.php");
  include("../componentes/sidebar.php");

  if (isset($_GET["id_usuario"])) {

    $id_usuarioP = $_GET["id_usuario"];

    $tu_usuario = $_SESSION["id_usuario"];

    $query = "SELECT * FROM t_usuarios WHERE id_usuario = $id_usuarioP ";

    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) == 1) {

      $fila = mysqli_fetch_array($res);

      ?>

      <img src="<?php echo $fila['foto_portada']; ?>" />

      <img src="<?php echo $fila["foto_perfil"]; ?>" />

      <h1>
        <?php echo $fila["usuario"]; ?>
      </h1>

      <?php

      if ($id_usuario === $tu_usuario) {

        // ES TU PERFIL
  
      } else {

        // NO ES TU PERFIL
  
      }

    }

    $query2 = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario WHERE id_usuario = '$id_usuario'";

    traerPublicaciones($query2);

  }

  ?>
</body>

</html>