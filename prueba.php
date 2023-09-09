<?php

require_once "app/modelO/conexion.php";

session_start();

$stmt = mysqli_prepare($con, "SELECT * FROM t_usuarios WHERE usuario = ?");

mysqli_stmt_bind_param($stmt, "s", $usuario);

$usuario = "chowsen";

if(mysqli_stmt_execute($stmt)){

    echo "Se hizo bien";

}else{

    echo "Mal";

}
?>