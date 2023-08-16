<!DOCTYPE html>
<html lang="en">

<?php include("../componentes/head.php"); ?>

<body>
  <?php
  include("../componentes/header.php");
  include("../componentes/sidebar.php");

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

        echo "<img src=" . $seguido["foto_perfil"] . " width='20px' alt='foto de perfil'>";
        
        echo "<a href='perfil.php?id_usuario=" . $seguido["id_usuario"] . "'>" . $seguido["usuario"] . "<br>";

      }

    }else{

      echo $usuario["usuario"] . " no sigue a nadie :(";

    }

  }