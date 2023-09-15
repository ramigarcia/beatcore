<?php

    session_start();

    unset($_SESSION["usuario"]);

    unset($_SESSION["id_usuario"]);

    unset($_SESSION["id_rol"]);

    session_destroy();

    header("location: ../../login.php");

?>