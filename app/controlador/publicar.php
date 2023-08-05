<?php

    include("../modelo/conexion.php");

    session_start();

    if(isset($_POST["btn_publicar"])){

        $id_usuario = $_SESSION["id_usuario"];
        
        $texto = $_POST["texto"];

        $query = "INSERT INTO t_publicaciones(id_usuario, texto) VALUES ('$id_usuario', '$texto')";

        $res = mysqli_query($con, $query);

        if($res){

            header("Location: ../vista/inicio.php");

        }

    }

?>