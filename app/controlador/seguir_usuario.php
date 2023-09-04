<?php

if (isset($_GET["id_usuario"])) {

  session_start();

  include("../modelo/conexion.php");

  $id_seguido = $_GET["id_usuario"];

  $id_seguidor = $_SESSION["id_usuario"];

  $query = "INSERT INTO t_seguidores(id_seguido, id_seguidor) VALUES('$id_seguido ', '$id_seguidor')";

  $res = mysqli_query($con, $query);

  if ($res) {

    header('Location:' . getenv('HTTP_REFERER'));

  }

}else{

  header('Location:' . getenv('HTTP_REFERER'));
  
}

?>