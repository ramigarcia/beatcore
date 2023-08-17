<?php

    if(isset($_GET["id_publicacion"])){

        session_start();
    
        include("../modelo/conexion.php");

        $id_publicacion = $_GET["id_publicacion"];

        $id_usuario = $_SESSION["id_usuario"];

        $query = "SELECT * FROM t_likes WHERE id_publicacion = '$id_publicacion' AND id_usuario = '$id_usuario'";

        $dio_like = mysqli_num_rows(mysqli_query($con, $query));

        if($dio_like){

            // SACAR EL LIKE

            $query = "DELETE FROM t_likes WHERE id_usuario = '$id_usuario' AND id_publicacion = '$id_publicacion'";

            $res = mysqli_query($con, $query);

            header("Location: ../vista/inicio.php");

        }else{

            // DAR LIKE

            $query = "INSERT INTO t_likes(id_usuario, id_publicacion, fecha_like) VALUES('$id_usuario', '$id_publicacion', now())";

            $res = mysqli_query($con, $query);

            if($res){

                header("Location: ../vista/inicio.php");

            }

        }

    }

?>