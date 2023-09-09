<?php

    if(isset($_POST["btn_comentar"])){

        include("../modelo/conexion.php");

        session_start();

        $id_usuario = $_SESSION["id_usuario"];

        $id_publicacion = $_GET["id_publicacion"];

        $texto = htmlentities($_POST["texto"]);

        if(isset($_GET["id_respuesta"])){

            $id_respuesta = $_GET["id_respuesta"];

            $stmt = mysqli_prepare($con, "INSERT INTO t_comentarios(id_usuario, id_publicacion, id_respuesta, texto, fecha_comentario) VALUES(?,?,?,?, now())");

            mysqli_stmt_bind_param($stmt, "iiis", $id_usuario, $id_publicacion, $id_respuesta, $texto);

        }else{

            $stmt = mysqli_prepare($con, "INSERT INTO t_comentarios(id_usuario, id_publicacion, texto, fecha_comentario) VALUES(?,?,?, now())");

            mysqli_stmt_bind_param($stmt, "iis", $id_usuario, $id_publicacion, $texto);

        }
        
        if(mysqli_stmt_execute($stmt)){

            mysqli_stmt_close($stmt);

            header('Location:' . getenv('HTTP_REFERER'));

        }

    }else{

        header('Location:' . getenv('HTTP_REFERER'));
        
      }

?>