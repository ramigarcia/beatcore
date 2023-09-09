<?php

include("../modelo/conexion.php");

session_start();

if (isset($_POST["btn_publicar"]) OR isset($_GET["id_publicacion"])) {

  $id_usuario = $_SESSION["id_usuario"];

  $texto = $_POST["texto"];

  // EN CASO DE SER RESPUESTA
  if(isset($_GET["id_publicacion"])){

    $stmt = mysqli_prepare($con, "INSERT INTO t_publicaciones(id_usuario, id_respuesta, texto) VALUES(?,?,?)");

    mysqli_stmt_bind_param($stmt, "iis", $id_usuario, $id_respuesta, $texto);

    $id_usuario = $_SESSION["id_usuario"];

    $id_respuesta = $_GET["id_publicacion"];

    $texto = htmlentities($_POST["texto"]);

    if(mysqli_stmt_execute($stmt)){

      mysqli_stmt_close($stmt);

      echo"<script>window.history.go(-2)</script>";

    }

  }else{
  
    $stmt = mysqli_prepare($con, "INSERT INTO t_publicaciones(id_usuario, texto) VALUES(?,?)");

    mysqli_stmt_bind_param($stmt, "is", $id_usuario, $texto);

    $id_usuario = $_SESSION["id_usuario"];

    $texto = htmlentities($_POST["texto"]);
    
    if(mysqli_stmt_execute($stmt)){

      mysqli_stmt_close($stmt);

      header("Location: ". getenv('HTTP_REFERER'));

    }

  }
}else{

  header('Location:' . getenv('HTTP_REFERER'));
  
}
?>