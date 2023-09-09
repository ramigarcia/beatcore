<?php

if (isset($_GET["id_usuario"])) {

  session_start();

  include("../modelo/conexion.php");

  $stmt = mysqli_prepare($con, "INSERT INTO t_seguidores(id_seguido, id_seguidor) VALUES(?,?)");

  mysqli_stmt_bind_param($stmt, "ii", $id_seguido, $id_seguidor);

  $id_seguido = $_GET["id_usuario"];

  $id_seguidor = $_SESSION["id_usuario"];

  if (mysqli_stmt_execute($stmt)) {

    header('Location:' . getenv('HTTP_REFERER'));

  }

}else{

  header('Location:' . getenv('HTTP_REFERER'));
  
}

?>