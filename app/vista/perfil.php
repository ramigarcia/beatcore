<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeatCore</title>
  <!-- CDN - BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- ESTILOS -->
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/perfil.css">
  <!-- META PROPS -->
</head>

<body>
  <?php include("../componentes/header.php"); ?>
  <div class="wrapper">
    <?php include("../componentes/sidebar.php"); ?>
    <div class="perfilDatos">
      <?php
      if (isset($_GET["id_usuario"])) {
        $id_usuarioP = $_GET["id_usuario"];

        $tu_usuario = $_SESSION["id_usuario"];

        $query = "SELECT * FROM t_usuarios WHERE id_usuario = $id_usuarioP ";

        $res = mysqli_query($con, $query);

        if (mysqli_num_rows($res) == 1) {

          $fila = mysqli_fetch_array($res);
          ?>
          <div class="contenedor-portada-perfil">
            <img src="<?= FOTO_PORTADA . $fila["foto_portada"]?>" />

            <img width="200px" class="img-perfil" src="<?= FOTO_PERFIL . $fila["foto_perfil"]?>" />
          </div>

          <h1>
            <?php echo $fila["usuario"]; ?>
          </h1>

          <h2>
            <?= $fila["nombre"] . " " . $fila["apellido"]; ?>
          </h2>

          <p>
            <?= $fila["descripcion"]; ?>
          </p>

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
    </div>
  </div>

</body>

</html>