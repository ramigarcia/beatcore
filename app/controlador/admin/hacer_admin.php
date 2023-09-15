<?php

    if(isset($_GET["id_usuario"])){

    include("../../modelo/conexion.php");

    session_start();

    $stmt = mysqli_prepare($con, "UPDATE t_usuarios SET id_rol = '2' WHERE id_usuario = ?");

    mysqli_stmt_bind_param($stmt, "i", $_GET["id_usuario"]);

    if(mysqli_stmt_execute($stmt)){

        mysqli_stmt_close($stmt);

        header("Location: ../../vista/inicio.php");

    }

}

?>