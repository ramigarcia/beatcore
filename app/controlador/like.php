<?php

session_start();

include("../modelo/conexion.php");

if (isset($_GET["id_publicacion"])) {

  $id_publicacion = $_GET["id_publicacion"];

  $id_usuario = $_SESSION["id_usuario"];

  $query = "SELECT * FROM t_likes WHERE id_publicacion = '$id_publicacion' AND id_usuario = '$id_usuario'";

  $dio_like = mysqli_num_rows(mysqli_query($con, $query));

  $stmt = mysqli_prepare($con, "SELECT COUNT(*) dio_like FROM t_likes WHERE id_publicacion = ? AND id_usuario = ?");

  mysqli_stmt_bind_param($stmt, "ii", $id_publicacion, $id_usuario);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $dio_like);

  mysqli_stmt_fetch($stmt);

  if ($dio_like == true) {

    // SACAR EL LIKE

    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($con, "DELETE FROM t_likes WHERE id_usuario = ? AND id_publicacion = ?");

    mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_publicacion);

  } else {

    // DAR LIKE

    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($con, "INSERT INTO t_likes(id_usuario, id_publicacion, fecha_like) VALUES(?,?, now())");

    mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_publicacion);

  }

  if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header('Location:' . getenv('HTTP_REFERER'));

  }


} else if (isset($_GET["id_comentario"])) {

  $id_comentario = $_GET["id_comentario"];

  $id_publicacion_c = $_GET["id_publicacion_c"];

  $id_usuario = $_SESSION["id_usuario"];

  $query = "SELECT * FROM t_likes WHERE id_comentario = '$id_comentario' AND id_usuario = '$id_usuario'";

  $dio_like = mysqli_num_rows(mysqli_query($con, $query));

  $stmt = mysqli_prepare($con, "SELECT COUNT(*) dio_like FROM t_likes WHERE id_comentario = ? AND id_usuario = ?");

  mysqli_stmt_bind_param($stmt, "ii", $id_comentario, $id_usuario);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $dio_like);

  mysqli_stmt_fetch($stmt);

  if ($dio_like == true) {

    // SACAR EL LIKE

    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($con, "DELETE FROM t_likes WHERE id_usuario = ? AND id_comentario = ?");

    mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_comentario);

  } else {

    // DAR LIKE

    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($con, "INSERT INTO t_likes(id_usuario, id_comentario, fecha_like) VALUES(?,?, now())");

    mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_comentario);

  }

  if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header('Location:' . getenv('HTTP_REFERER'));

  }

} else {

  header('Location:' . getenv('HTTP_REFERER'));

}

?>