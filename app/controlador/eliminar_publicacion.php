<?php

    if(isset($_GET["id_publicacion"])){

        include("../modelo/conexion.php");

        mysqli_query($con, "DELETE FROM t_publicaciones WHERE id_publicacion = '$_GET[id_publicacion]'");

        header('Location:' . getenv('HTTP_REFERER'));

    }

?>