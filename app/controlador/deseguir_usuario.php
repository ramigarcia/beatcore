<?php

if (isset($_GET["id_usuario"])) {

  session_start();

  include("../modelo/conexion.php");

  $stmt = mysqli_prepare($con, "DELETE FROM t_seguidores WHERE id_seguidor = ? AND id_seguido = ?");

  mysqli_stmt_bind_param($stmt, "ii", $id_seguidor, $id_seguido);

  $id_seguido = $_GET["id_usuario"];

  $id_seguidor = $_SESSION["id_usuario"];

  mysqli_stmt_execute($stmt);

  header('Location:' . getenv('HTTP_REFERER'));

}else{

  header('Location:' . getenv('HTTP_REFERER'));
  
}

?>