<?php
include("../../../modelo/conexion.php");
include("./cantidadLikes.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $query = $_POST["query"];

  $publicaciones = traerPublicaciones($query);
  echo $publicaciones;
}

function traerPublicaciones($query)
{
  include("../../../modelo/conexion.php");

  $res = mysqli_query($con, $query);

  if (mysqli_num_rows($res) > 0) {
    $output = "<ul>";
    while ($fila = mysqli_fetch_array($res)) {
      $output .= "
      <div class='publicacion' data-id='{$fila["id_publicacion"]}' data-liked='false'>
        <p>{$fila["texto"]}</p>
        <button class='btn-like'>Like</button>
        <span class='conteo-likes'>" .
        cantidadLikesPublicacion($fila["id_publicacion"])
        . "</span>
      </div>";
    }
    $output .= "</ul>";
    return $output;
  } else {
    return "No hay publicaciones";
  }
}
?>