<?php

    if(isset($_GET["id_seguidor"])){

        session_start();

        include("../modelo/conexion.php");

        $id_seguidor = $_GET["id_seguidor"];

        $id_usuario = $_SESSION["id_usuario"];

        $query = "DELETE FROM t_seguidores WHERE id_seguidor = '$id_seguidor' AND id_seguido = '$id_usuario'";

        $res = mysqli_query($con, $query);

        $_SESSION["msj"] = "Se eliminó al seguidor con éxito";

        header('Location:' . getenv('HTTP_REFERER'));

    }else{

        header('Location:' . getenv('HTTP_REFERER'));
        
      }

?>