<?php

function traerPublicaciones($query)
{

  include("../modelo/conexion.php");

  $res = mysqli_query($con, $query);

  if (mysqli_num_rows($res) > 0) {

    ?><ul><?php

    while ($fila = mysqli_fetch_array($res)) {

      ?>

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

            <a href="#?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img
                src="../../publico/img/iconos/compartir.png" /></a>

            <a href="#?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img
                src="../../publico/img/iconos/guardar_regular.png" /></a>

            <a href="#?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img
                src="../../publico/img/iconos/responder.png" /></a>

            <?php echo cantidadRespuestas($fila["id_publicacion"]); ?>

            <a href="publicacion.php?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img
                src="../../publico/img/iconos/comentar.png" /></a>

            <?php echo cantidadComentarios($fila["id_publicacion"]); ?>

            <?php likes($fila["id_publicacion"]); ?>

          </div>

        </li>

      <?php

    }

    ?></ul><?php

  } else {

    echo "No hay publicaciones";

  }

}
// INICIO - FUNCIONES DE LIKE
function likes($id_publicacion){

  include("../modelo/conexion.php");

  $id_usuario = $_SESSION["id_usuario"];

  $query = "SELECT * FROM t_likes WHERE id_usuario = '$id_usuario' AND id_publicacion = '$id_publicacion'";

  $dio_like = mysqli_num_rows(mysqli_query($con, $query));

  if($dio_like){

    ?><a href="../controlador/like.php?id_publicacion=<?php echo $id_publicacion ?>"><img src="../../publico/img/iconos/like_solido.png" /></a><?php

  }else{

    ?><a href="../controlador/like.php?id_publicacion=<?php echo $id_publicacion ?>"><img src="../../publico/img/iconos/like_regular.png" /></a><?php

  }

  echo cantidadLikes($id_publicacion);

}

function cantidadLikes($id_publicacion)
{

  include("../modelo/conexion.php");

  $query = "SELECT * FROM t_likes WHERE id_publicacion = '$id_publicacion'";

  $res = mysqli_query($con, $query);

  return mysqli_num_rows($res);

}
// FIN - FUNCIONES DE LIKE

// INICIO - FUNCIONES COMENTARIOS
function traerComentarios($query){

  include("../modelo/conexion.php");

  $res = mysqli_query($con, $query);

  if(mysqli_num_rows($res) > 0){

    ?><ul><?php

    while($fila = mysqli_fetch_array($res)){

      ?>
      
        <li>

          <img src="<?php echo $fila["foto_perfil"]; ?>" width="20px" alt="Foto de perfil">

          <a href="perfil.php?id_usuario=<?php echo $fila["id_usuario"]; ?>"><?php echo $fila["usuario"]; ?></a>

          <p><?php echo $fila["texto"]; ?></p>

        </li>
      
      <?php

    }

    ?></ul><?php

  }

}

function cantidadComentarios($id_publicacion)
{

  include("../modelo/conexion.php");

  $query = "SELECT * FROM t_comentarios WHERE id_publicacion = '$id_publicacion'";

  $res = mysqli_query($con, $query);

  return mysqli_num_rows($res);

}
// FIN - FUNCIONES COMENTARIOS

// INICIO - FUNCIONES RESPUESTAS
function cantidadRespuestas($id_publicacion)
{

  include("../modelo/conexion.php");

  $query = "SELECT * FROM t_publicaciones WHERE id_respuesta = '$id_publicacion'";

  $res = mysqli_query($con, $query);

return mysqli_num_rows($res);

}
// FIN - FUNCIONES RESPUESTAS

// INICIO - FUNCIONES DE USUARIO
function datosUsuario($id_usuario, $datos)
{

  include("../modelo/conexion.php");

  $query = "SELECT $datos FROM t_usuarios WHERE id_usuario = '$id_usuario'";

  $res = mysqli_query($con, $query);

  return mysqli_fetch_array($res);

}
// FIN - FUNCIONES DE USUARIO

?>