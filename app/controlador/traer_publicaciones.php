<?php

    include("../modelo/conexion.php");

    $id_usuario = $_SESSION["id_usuario"];

    $res = mysqli_query($con, $query);

    if(mysqli_num_rows($res) > 0){

        while($fila = mysqli_fetch_array($res)){

            ?>
            
                <div class="publicacion">

                    <img src="<?php echo $fila["foto_perfil"]; ?>" width="20px" alt="foto de perfil" />

                    <a href="perfil.php?id_usuario=<?php echo $fila["id_usuario"]; ?>"><?php echo $fila["usuario"]; ?></a>

                    <div class="publicacion-contenido">

                        <p><?php echo $fila["texto"]; ?></p>

                    </div>

                    <a href="#"><img src="../publico/img/iconos/compartir.png"/></a>

                    <a href="#"><img src="../publico/img/iconos/responder.png"/></a>

                    <a href="#"><img src="../publico/img/iconos/guardar_regular.png"/></a>

                    <a href="#"><img src="../publico/img/iconos/comentar.png"/></a>

                    <a href="#"><img src="../publico/img/iconos/like_regular.png"/></a>

                </div>

            <?php

        }

    }else{

        echo "No hay publicaciones";

    }

?>