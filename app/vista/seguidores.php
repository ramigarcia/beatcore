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

    echo "<h2>Seguidores de " . $usuario["usuario"] . "</h2>";

    $query = "SELECT * FROM t_seguidores WHERE id_seguido = '$id_usuario'";

    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) > 0) {

      while ($fila = mysqli_fetch_array($res)) {

        $id_seguidor = $fila["id_seguidor"];

        $q_seguidor = "SELECT foto_perfil, usuario FROM t_usuarios INNER JOIN t_seguidores ON t_usuarios.id_usuario = t_seguidores.id_seguidor WHERE id_seguidor = '$id_seguidor'";

        $r_seguidor = mysqli_query($con, $q_seguidor);

        $seguidor = mysqli_fetch_array($r_seguidor);

        echo "<img src=" . $seguidor["foto_perfil"] . " width='20px' alt='foto de perfil'>" . $seguidor["usuario"] . "<br>";

      }

    }

  }