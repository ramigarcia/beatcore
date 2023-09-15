<?php

include("../../modelo/conexion.php");

session_start();

if($_SESSION["id_rol"] == 2){

    $query = "DELETE FROM t_usuarios WHERE id_rol != '2'";

    if(mysqli_query($con, $query)){

        header("Location: ../../vista/inicio.php");

    }

}

?>