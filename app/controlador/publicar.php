<?php

include("../modelo/conexion.php");

session_start();

if (isset($_POST["btn_publicar"]) OR isset($_GET["id_publicacion"])) {

  $id_usuario = $_SESSION["id_usuario"];

  $texto = $_POST["texto"];

  // EN CASO DE SER RESPUESTA
  if(isset($_GET["id_publicacion"])){
    $id_respuesta = $_GET["id_publicacion"];

    $query = "INSERT INTO t_publicaciones(id_usuario, id_respuesta, texto) VALUES ('$id_usuario', '$id_respuesta', '$texto')";

  }else{
  
    $query = "INSERT INTO t_publicaciones(id_usuario, texto) VALUES ('$id_usuario', '$texto')";

  }

  $res = mysqli_query($con, $query);

  if ($res) {
    header("Location: ../vista/inicio.php");
  }
}
?>