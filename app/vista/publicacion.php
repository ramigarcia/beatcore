<!DOCTYPE html>
<html lang="en">
<!-- HEAD -->
<?php
include("../componentes/head.php");
?>

<body>
  <?php
  include("../componentes/header.php");

  if (empty($_SESSION["usuario"])) {
    header("location: ../../");
  }

//   include("../componentes/sidebar.php");

    if(isset($_GET["id_publicacion"])){

        include("../modelo/conexion.php");

        $id_publicacion = $_GET["id_publicacion"];

        $query = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario WHERE id_publicacion = '$id_publicacion' ORDER BY id_publicacion DESC";

        traerPublicaciones($query);

        ?>
        
            <h3>Nuevo comentario</h3>

            <form action="../controlador/comentar.php?id_publicacion=<?php echo $id_publicacion; ?>" method="POST">

                <label for="texto">

                    <span></span>

                    <input name="texto" id="texto" autofocus>

                </label>

                <input type="submit" name="btn_comentar" value="Comentar">

            </form>

        <?php

        $query = "SELECT * FROM t_comentarios INNER JOIN t_usuarios ON t_comentarios.id_usuario = t_usuarios.id_usuario WHERE id_publicacion = '$id_publicacion' ORDER BY id_comentario DESC";

        traerComentarios($query);

    }

?>