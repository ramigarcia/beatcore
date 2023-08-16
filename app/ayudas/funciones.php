<?php

    function traerPublicaciones($query){

        include("../modelo/conexion.php");

        $res = mysqli_query($con, $query);

        if (mysqli_num_rows($res) > 0) {

        while ($fila = mysqli_fetch_array($res)) {

            ?>

            <ul>

                <li>

                <div class="publicacion">

                    <!-- <img src="<?php //echo $fila["foto_perfil"]; ?>" width="20px" alt="foto de perfil" /> -->
                    <img src="../../publico/img/foto_perfil/por_defecto.png" width="20px" alt="foto de perfil" />

                    <a href="perfil.php?id_usuario=<?php echo $fila["id_usuario"]; ?>"><?php echo $fila["usuario"]; ?></a>

                    <div class="publicacion-contenido">

                    <p>
                        <?php echo $fila["texto"]; ?>
                    </p>

                    </div>

                    <a href="#?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img src="../../publico/img/iconos/compartir.png" /></a>

                    <a href="#?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img src="../../publico/img/iconos/guardar_regular.png" /></a>

                    <a href="#?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img src="../../publico/img/iconos/responder.png" /></a>

                    <?php echo cantidadRespuestas($fila["id_publicacion"]); ?>

                    <a href="#?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img src="../../publico/img/iconos/comentar.png" /></a>

                    <?php echo cantidadComentarios($fila["id_publicacion"]); ?>

                    <a href="../controlador/like.php?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img src="../../publico/img/iconos/like_regular.png" /></a>

                    <?php echo cantidadLikes($fila["id_publicacion"]); ?>

                </div>
                
                </li>
            
            </ul>
            
            <?php

        }

        } else {

        echo "No hay publicaciones";

        }

    }

    function cantidadLikes($id_publicacion){

        include("../modelo/conexion.php");

        $query = "SELECT * FROM t_likes WHERE id_publicacion = '$id_publicacion'";

        $res = mysqli_query($con, $query);

        return mysqli_num_rows($res);

    }

    function cantidadComentarios($id_publicacion){

        include("../modelo/conexion.php");

        $query = "SELECT * FROM t_comentarios WHERE id_publicacion = '$id_publicacion'";

        $res = mysqli_query($con, $query);

        return mysqli_num_rows($res);

    }

    function cantidadRespuestas($id_publicacion){

        include("../modelo/conexion.php");

        $query = "SELECT * FROM t_publicaciones WHERE id_respuesta = '$id_publicacion'";

        $res = mysqli_query($con, $query);

        return mysqli_num_rows($res);

    }

?>