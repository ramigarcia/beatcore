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
  <!-- META PROPS -->
</head>

<body>
  <?php include("../componentes/header.php"); ?>
  <div class="wrapper">

    <?php include("../componentes/sidebar.php"); ?>
    <div class="segudios">

      <?php
      if (isset($_GET['id_usuario'])) {

        $id_usuario = $_GET["id_usuario"];

        $query = "SELECT usuario FROM t_usuarios WHERE id_usuario = '$id_usuario'";

        $res = mysqli_query($con, $query);

        $usuario = mysqli_fetch_array($res);

        echo "<h2>Personas a las que sigue <a href='perfil.php?id_usuario=" . $id_usuario . "'>" . $usuario["usuario"] . "</a></h2>";

        $query = "SELECT * FROM t_seguidores WHERE id_seguidor = '$id_usuario'";

        $res = mysqli_query($con, $query);

        if (mysqli_num_rows($res) > 0) {

          while ($fila = mysqli_fetch_array($res)) {
            $id_seguido = $fila["id_seguido"];

            $q_seguido = "SELECT foto_perfil, usuario, id_usuario FROM t_usuarios INNER JOIN t_seguidores ON t_usuarios.id_usuario = t_seguidores.id_seguido WHERE id_seguido = '$id_seguido'";

            $r_seguido = mysqli_query($con, $q_seguido);

            $seguido = mysqli_fetch_array($r_seguido);
            ?>
            <ul>
              <li>
                <img src="<?= FOTO_PERFIL . $seguido["foto_perfil"]?>" width="20px" alt="Foto de perfil">

                <a href="perfil.php?id_usuario=<?php echo $seguido["id_usuario"]; ?>"><?php echo $seguido["usuario"]; ?></a>

                <?php

                if ($id_usuario == $_SESSION["id_usuario"]) {

                  ?><a
                    href="../controlador/deseguir_usuario.php?id_usuario=<?php echo $seguido["id_usuario"]; ?>">Dejar de seguir</a>
                  <?php

                }

                ?>

              </li>
            </ul>
            <?php
          }
        } else {
          echo $usuario["usuario"] . " no sigue a nadie :(";
        }
      } ?>
    </div>
  </div>
</body>

</html>