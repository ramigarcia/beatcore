<?php

    if(isset($_POST["btn_editar"])){

        include("../modelo/conexion.php");

        include("../ayudas/funciones.php");

        session_start();

        $id_usuario = $_SESSION["id_usuario"];

        $fotos_usuario = datosUsuario($id_usuario, "foto_perfil, foto_portada");

        if($_FILES["foto_perfil"]["name"] == ""){

            $foto_perfil = $fotos_usuario["foto_perfil"];

        }else{

            $foto_perfil = "../../publico/img/foto_perfil/". $_FILES["foto_perfil"]["name"];

        }

        if($_FILES["foto_portada"]["name"] == ""){

            $foto_portada = $fotos_usuario["foto_portada"];

        }else{

            $foto_portada = "../../publico/img/foto_portada/". $_FILES["foto_portada"]["name"];

        }

        $usuario = $_POST["usuario"];

        $nombre = $_POST["nombre"];
        
        $apellido = $_POST["apellido"];

        $descr = $_POST["descr"];

        $query = "UPDATE t_usuarios SET foto_perfil = '$foto_perfil', foto_portada = '$foto_portada', usuario = '$usuario', nombre = '$nombre', apellido = '$apellido', descripcion = '$descr' WHERE id_usuario = '$id_usuario'";

        $res = mysqli_query($con, $query);

        header("Location: ../vista/perfil.php?id_usuario=". $id_usuario);

    }

?>