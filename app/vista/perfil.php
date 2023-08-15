<!DOCTYPE html>
<html lang="en">

<?php include("../componentes/head.php"); ?>

<body>
  <?php
  include("../componentes/header.php");
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

      // if ($id_usuarioP === $tu_usuario) {
  
      //   // ES TU PERFIL
  
      // } else {
  
      //   // NO ES TU PERFIL
  
      // }
  
      $query2 = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario WHERE t_usuarios.id_usuario = '$id_usuarioP'";
    }


    $res = mysqli_query($con, $query2);

    if (mysqli_num_rows($res) > 0) {

      while ($fila = mysqli_fetch_array($res)) {

        ?>

        <div class="publicacion">

          <!-- <img src="<?php //echo $fila["foto_perfil"]; ?>" width="20px" alt="foto de perfil" /> -->
          <img src="../../publico/img/foto_perfil/por_defecto.png" width="20px" alt="foto de perfil" />

          <a href="perfil.php?id_usuario=<?php echo $fila["id_usuario"]; ?>"><?php echo $fila["usuario"]; ?></a>

          <div class="publicacion-contenido">

            <p>
              <?php echo $fila["texto"]; ?>
            </p>

          </div>

          <a href="#"><img src="../../publico/img/iconos/compartir.png" /></a>

          <a href="#"><img src="../../publico/img/iconos/responder.png" /></a>

          <a href="#"><img src="../../publico/img/iconos/guardar_regular.png" /></a>

          <a href="#"><img src="../../publico/img/iconos/comentar.png" /></a>

          <a href="#"><img src="../../publico/img/iconos/like_regular.png" /></a>

        </div>

        <?php

      }

    } else {

      echo "No hay publicaciones";

    }

  }



  ?>
</body>

</html>