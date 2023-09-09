<?php

    if(isset($_GET["id_publicacion"])){

        include("../modelo/conexion.php");

        $stmt = mysqli_prepare($con, "DELETE FROM t_publicaciones WHERE id_publicacion = ?");

        mysqli_stmt_bind_param($stmt, "i", $id_publicacion);

        $id_publicacion = $_GET["id_publicacion"];

        if(mysqli_stmt_execute($stmt)){

            mysqli_stmt_close($stmt);

            header('Location:' . getenv('HTTP_REFERER'));

        }

    }

?>