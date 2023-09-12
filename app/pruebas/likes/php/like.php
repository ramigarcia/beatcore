<?php
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = json_decode(file_get_contents("php://input"));
  $idPublicacion = $data->id;
  $idUsuario = 27;
  $liked = $data->liked;

  $nuevoConteoLikes = actualizarLikes($idPublicacion, $liked, $idUsuario);

  if ($nuevoConteoLikes !== false) {
    // Devuelve la respuesta en formato JSON
    echo json_encode(['success' => true, 'liked' => $liked, 'likes' => $nuevoConteoLikes]);
  } else {
    echo json_encode(['success' => false]);
  }
}

function actualizarLikes($idPublicacion, $liked, $idUsuario)
{
  include("../../../modelo/conexion.php");
  if ($liked === true) {
    // SACAR EL LIKE
    $stmt = mysqli_prepare($con, "DELETE FROM t_likes WHERE id_usuario = ? AND id_publicacion = ?");

    mysqli_stmt_bind_param($stmt, "ii", $idUsuario, $idPublicacion);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $likesConteo = conteoLikes($idPublicacion);
    return $likesConteo; // Reemplaza con el conteo real
  } else {
    // DAR LIKE
    $stmt = mysqli_prepare($con, "INSERT INTO t_likes(id_usuario, id_publicacion, fecha_like) VALUES(?,?, now())");

    mysqli_stmt_bind_param($stmt, "ii", $idUsuario, $idPublicacion);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $likesConteo = conteoLikes($idPublicacion);
    return $likesConteo; // Reemplaza con el conteo real
  }
}

function conteoLikes($id_p)
{
  include("../../../modelo/conexion.php");

  $query = "SELECT * FROM t_likes WHERE id_publicacion = '$id_p'";

  $res = mysqli_query($con, $query);

  return mysqli_num_rows($res);
}