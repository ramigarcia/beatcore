<?php

if (isset($_GET["id_usuario"])) {

  session_start();

  include("../modelo/conexion.php");

  $id_seguido = $_GET["id_usuario"];

  $id_seguidor = $_SESSION["id_usuario"];

  $query = "DELETE FROM t_seguidores WHERE id_seguidor = '$id_seguidor' AND id_seguido = '$id_seguido'";

  $res = mysqli_query($con, $query);

  header("Location: ../vista/perfil.php?id_usuario=" . $id_seguido);

}

?>