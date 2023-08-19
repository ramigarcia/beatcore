<?php

    if(isset($_POST["btn_comentar"])){

        include("../modelo/conexion.php");

        session_start();

        $id_usuario = $_SESSION["id_usuario"];

        $id_publicacion = $_GET["id_publicacion"];

        $texto = $_POST["texto"];

        if(isset($_GET["id_respuesta"])){

            $id_respuesta = $_GET["id_respuesta"];

            $query = "INSERT INTO t_comentarios(id_usuario, id_publicacion, id_respuesta, texto, fecha_comentario) VALUES('$id_usuario','$id_publicacion', '$id_respuesta',  '$texto', now())";

            $url = "../vista/comentario.php?id_comentario=". $id_respuesta;

        }else{

            $query = "INSERT INTO t_comentarios(id_usuario, id_publicacion,  texto, fecha_comentario) VALUES('$id_usuario','$id_publicacion',  '$texto', now())";

            $url = "../vista/publicacion.php?id_publicacion=". $id_publicacion;

        }
        
        $res = mysqli_query($con, $query);

        if($res){

            header("Location: $url");

        }

    }

?>