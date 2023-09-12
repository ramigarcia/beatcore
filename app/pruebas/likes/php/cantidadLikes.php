<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $id_p = $_GET["id_publicacion"];

  $cantidad = cantidadLikesPublicacion($id_p);
  echo $cantidad;
}
function cantidadLikesPublicacion($id_p)
{
  include("../../../modelo/conexion.php");

  $query = "SELECT * FROM t_likes WHERE id_publicacion = '$id_p'";

  $res = mysqli_query($con, $query);

  $likes = mysqli_num_rows($res);
  return $likes;
}