<!DOCTYPE html>
<html lang="en">

<?php 
include("../componentes/head.php");
?>
<body>
  <?php
  include("../componentes/header.php");
  include("../componentes/sidebar.php");

  if (isset($_GET['id_usuario'])) {

    $id_usuario = $_GET["id_usuario"];

    $query = "SELECT usuario FROM t_usuarios WHERE id_usuario = '$id_usuario'";

    $res = mysqli_query($con, $query);

    $usuario = mysqli_fetch_array($res);

    echo "<h2>Seguidores de <a href='perfil.php?id_usuario=" . $id_usuario . "'>" . $usuario["usuario"] . "</a></h2>";

    // INICIO - MENSAJE

      if(isset($_SESSION["msj"])){

        echo $_SESSION["msj"];

        unset($_SESSION["msj"]);

      }

    // FINAL - MENSAJE

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
              
                if($id_usuario == $_SESSION["id_usuario"]){

                  ?><a href="../controlador/eliminar_seguidor.php?id_seguidor=<?php echo $seguidor["id_usuario"]; ?>">Eliminar</a><?php

                }

              ?>

            </li>

          </ul>
        
        <?php
      }

    }else{

      echo "Nadie sigue a " . $usuario["usuario"] . " :(";

    }

  }