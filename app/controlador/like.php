<?php

session_start();

include("../modelo/conexion.php");

if (isset($_GET["id_publicacion"])) {

  $id_publicacion = $_GET["id_publicacion"];

  $id_usuario = $_SESSION["id_usuario"];

  $query = "SELECT * FROM t_likes WHERE id_publicacion = '$id_publicacion' AND id_usuario = '$id_usuario'";

  $dio_like = mysqli_num_rows(mysqli_query($con, $query));

  if ($dio_like) {

    // SACAR EL LIKE

    $query = "DELETE FROM t_likes WHERE id_usuario = '$id_usuario' AND id_publicacion = '$id_publicacion'";

    $res = mysqli_query($con, $query);

  } else {

    // DAR LIKE

    $query = "INSERT INTO t_likes(id_usuario, id_publicacion, fecha_like) VALUES('$id_usuario', '$id_publicacion', now())";

    $res = mysqli_query($con, $query);

  }

  header('Location:' . getenv('HTTP_REFERER'));

} else if (isset($_GET["id_comentario"])) {

  $id_comentario = $_GET["id_comentario"];

  $id_publicacion_c = $_GET["id_publicacion_c"];

  $id_usuario = $_SESSION["id_usuario"];

  $query = "SELECT * FROM t_likes WHERE id_comentario = '$id_comentario' AND id_usuario = '$id_usuario'";

  $dio_like = mysqli_num_rows(mysqli_query($con, $query));

  if ($dio_like) {

    // SACAR EL LIKE

    $query = "DELETE FROM t_likes WHERE id_usuario = '$id_usuario' AND id_comentario = '$id_comentario'";

    $res = mysqli_query($con, $query);

  } else {

    // DAR LIKE

    $query = "INSERT INTO t_likes(id_usuario, id_comentario, fecha_like) VALUES('$id_usuario', '$id_comentario', now())";

    $res = mysqli_query($con, $query);

  }

  header('Location:' . getenv('HTTP_REFERER'));

} else {

  header('Location:' . getenv('HTTP_REFERER'));

}

?>