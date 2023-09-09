<?php

    if(isset($_GET["id_seguidor"])){

        session_start();

        include("../modelo/conexion.php");

        $id_seguidor = $_GET["id_seguidor"];

        $id_usuario = $_SESSION["id_usuario"];

        $stmt = mysqli_prepare($con, "DELETE FROM t_seguidores WHERE id_seguidor = ? AND id_seguido = ?");

        mysqli_stmt_bind_param($stmt, "ii", $id_seguidor, $id_usuario);

        if(mysqli_stmt_execute($stmt)){

            $_SESSION["msj"] = "Se eliminó al seguidor con éxito";
    
            mysqli_stmt_close($stmt);

            header('Location:' . getenv('HTTP_REFERER'));

        }

    }else{

        header('Location:' . getenv('HTTP_REFERER'));
        
      }

?>