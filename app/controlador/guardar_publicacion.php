<?php

    if(isset($_GET["id_publicacion"])){

        session_start();

        include("../modelo/conexion.php");

        $id_usuario = $_SESSION["id_usuario"];

        $id_publicacion = $_GET["id_publicacion"];

        $query = "SELECT * FROM t_guardados WHERE id_usuario = '$id_usuario' AND id_publicacion = '$id_publicacion'";

        $lo_guardo = mysqli_num_rows(mysqli_query($con, $query));

        if($lo_guardo){

            // LO SACA DE GUARDADOS

            $query = "DELETE FROM t_guardados WHERE id_usuario = '$id_usuario' AND id_publicacion = '$id_publicacion'";

            mysqli_query($con, $query);

        }else{

            // LO GUARDA

            $query = "INSERT INTO t_guardados(id_usuario, id_publicacion) VALUES ('$id_usuario', '$id_publicacion')";

            $res = mysqli_query($con, $query);

        }

        header('Location:' . getenv('HTTP_REFERER'));

    }else{

        header('Location:' . getenv('HTTP_REFERER'));
        
      }

?>