<?php 

    include("../componentes/head.html");

    include("../componentes/header_vista_usuario.php");

    if(empty($_SESSION["usuario"])){

        header("location: ../../");

    }

    include("../componentes/sidebar.php");

    $query = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario";

    traerPublicaciones($query);

?>

<?php include("../componentes/footer.html"); ?>