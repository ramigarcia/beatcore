<!DOCTYPE html>
<html lang="en">
<?php
include("../componentes/head.php");
?>

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

      <h2><?= $fila["nombre"] ." ". $fila["apellido"]; ?></h2>

      <p><?= $fila["descripcion"]; ?></p>

      <?php

      if ($id_usuarioP != $tu_usuario) {

        // NO ES TU PERFIL
  
        $consulta = "SELECT * FROM t_seguidores WHERE id_seguidor = '$tu_usuario' AND id_seguido = '$id_usuarioP'";

        $si_sigue = mysqli_query($con, $consulta);

        if (mysqli_num_rows($si_sigue) == 1) {

          ?>

          <a href="../controlador/deseguir_usuario.php?id_usuario=<?php echo $fila['id_usuario']; ?>">Dejar de seguir</a>

          <?php

        } else {

          ?>

          <a href="../controlador/seguir_usuario.php?id_usuario=<?php echo $fila['id_usuario']; ?>">Seguir</a>

          <?php

        }

      }

      // INICIO - SEGUIDORES / SEGUIDOS
  
      $q_seguidores = "SELECT * FROM t_seguidores WHERE id_seguido = '$id_usuarioP'";

      $r_seguidores = mysqli_query($con, $q_seguidores);

      echo "<br><a href='seguidores.php?id_usuario=" . $id_usuarioP . "'>Seguidores</a>: " . mysqli_num_rows($r_seguidores);

      $q_seguidos = "SELECT * FROM t_seguidores WHERE id_seguidor = '$id_usuarioP'";

      $r_seguidos = mysqli_query($con, $q_seguidos);

      echo "<br><a href='seguidos.php?id_usuario=" . $id_usuarioP . "'>Seguidos</a>: " . mysqli_num_rows($r_seguidos);

      echo "<br>";

      // FIN - SEGUIDORES / SEGUIDOS
  
      $q_publicaciones = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario WHERE t_usuarios.id_usuario = '$id_usuarioP' ORDER BY id_publicacion DESC";

      traerPublicaciones($q_publicaciones);

    }

  }

  ?>

</body>

</html>