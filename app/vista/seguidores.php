<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeatCore</title>
  <!-- CDN - BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- ESTILOS -->
  <link rel="stylesheet" href="../css/main.css">
  <style>
    .seguidores {
      grid-area: contenidoP;
    }
  </style>
  <!-- META PROPS -->
</head>

<body>
  <?php
  include("../componentes/header.php");
  ?>
  <div class="wrapper">
    <?php
    include("../componentes/sidebar.php");

    if (isset($_GET['id_usuario'])) {

      $id_usuario = $_GET["id_usuario"];

      $usuario = datosUsuario($id_usuario, "usuario");

      ?>
      <div class="seguidores">
        <h2>Seguidores de <a href='perfil.php?id_usuario=<?php echo $id_usuario; ?>'><?php echo $usuario["usuario"]; ?></a>
        </h2>
        <?php

        // INICIO - MENSAJE
      
        if (isset($_SESSION["msj"])) {

          echo $_SESSION["msj"];

          unset($_SESSION["msj"]);

        }
        // FINAL - MENSAJE
        ?>

        <?php
        $query = "SELECT * FROM t_seguidores WHERE id_seguido = '$id_usuario'";

        $res = mysqli_query($con, $query);

        if (mysqli_num_rows($res) > 0) {

          while ($fila = mysqli_fetch_array($res)) {

            $id_seguidor = $fila["id_seguidor"];

            $q_seguidor = "SELECT foto_perfil, usuario, id_usuario FROM t_usuarios INNER JOIN t_seguidores ON t_usuarios.id_usuario = t_seguidores.id_seguidor WHERE id_seguidor = '$id_seguidor'";

            $r_seguidor = mysqli_query($con, $q_seguidor);

            $seguidor = mysqli_fetch_array($r_seguidor);

            ?>

            <ul>
              <li>
                <img src="<?php echo $seguidor["foto_perfil"] ?>" width="20px">

                <a href="perfil.php?id_usuario=<?php echo $seguidor["id_usuario"]; ?>"><?php echo $seguidor["usuario"]; ?></a>

                <?php

                if ($id_usuario == $_SESSION["id_usuario"]) {

                  ?><a
                    href="../controlador/eliminar_seguidor.php?id_seguidor=<?php echo $seguidor["id_usuario"]; ?>">Eliminar</a>
                  <?php

                }

                ?>

              </li>

            </ul>

            <?php
          }

        } else {

          echo "Nadie sigue a " . $usuario["usuario"] . " :(";

        }

    } ?>
    </div>
  </div>
</body>

</html>