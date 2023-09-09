<?php

    if(isset($_GET["id_publicacion"])){

        session_start();

        include("../modelo/conexion.php");

        $id_usuario = $_SESSION["id_usuario"];

        $id_publicacion = $_GET["id_publicacion"];

        $query = "SELECT * FROM t_guardados WHERE id_usuario = '$id_usuario' AND id_publicacion = '$id_publicacion'";

        $stmt = mysqli_prepare($con, "SELECT COUNT(*) guardado FROM t_guardados WHERE id_usuario = ? AND id_publicacion = ?");

        mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_publicacion);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $guardado);

        mysqli_stmt_fetch($stmt);

        if($guardado == true){

            // LO SACA DE GUARDADOS

            mysqli_stmt_close($stmt);

            $stmt = mysqli_prepare($con, "DELETE FROM t_guardados WHERE id_usuario = ? AND id_publicacion = ?");

            mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_publicacion);

        }else{

            // LO GUARDA

            mysqli_stmt_close($stmt);

            $stmt = mysqli_prepare($con, "INSERT INTO t_guardados(id_usuario, id_publicacion) VALUES (?, ?)");

            mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_publicacion);

        }

        if(mysqli_stmt_execute($stmt)){

            mysqli_stmt_close($stmt);

            header('Location:' . getenv('HTTP_REFERER'));

        }
        
    }else{

        header('Location:' . getenv('HTTP_REFERER'));
        
      }

?>