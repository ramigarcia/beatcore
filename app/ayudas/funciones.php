<?php

function traerPublicaciones($query)
{
  include("../modelo/conexion.php");

  $res = mysqli_query($con, $query);

  if (mysqli_num_rows($res) > 0) {
    ?>
    <ul>
      <?php while ($fila = mysqli_fetch_array($res)) { ?>
        <li>
          <div class="carta-publi">

            <img src="<?= $fila["foto_perfil"]; ?>" width="20px" alt="foto de perfil" />

            <a href="perfil.php?id_usuario=<?php echo $fila["id_usuario"]; ?>"><?php echo $fila["usuario"]; ?></a>

            <div class="publicacion-contenido">

              <p>
                <?php echo $fila["texto"]; ?>
              </p>

            </div>

            <a href="#?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img
                src="../../publico/img/iconos/compartir.png" /></a>

            <?php guardar($fila["id_publicacion"]); ?>

            <a href="#?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img
                src="../../publico/img/iconos/responder.png" /></a>

            <?php echo cantidadRespuestas($fila["id_publicacion"]); ?>

            <a href="publicacion.php?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><img
                src="../../publico/img/iconos/comentar.png" /></a>

            <?php echo cantidadComentarios($fila["id_publicacion"]); ?>

            <?php likesPublicacion($fila["id_publicacion"]); ?>

          </div>

        </li>

        <?php

      }

      ?>
    </ul>
    <?php

  } else {

    echo "No hay publicaciones";

  }

}
// INICIO - FUNCIONES DE LIKE
function likesPublicacion($id_publicacion)
{

  include("../modelo/conexion.php");

  $id_usuario = $_SESSION["id_usuario"];

  $query = "SELECT * FROM t_likes WHERE id_usuario = '$id_usuario' AND id_publicacion = '$id_publicacion'";

  $dio_like = mysqli_num_rows(mysqli_query($con, $query));

  if ($dio_like) {

    ?><a href="../controlador/like.php?id_publicacion=<?php echo $id_publicacion ?>"><img
        src="../../publico/img/iconos/like_solido.png" /></a>
    <?php

  } else {

    ?><a href="../controlador/like.php?id_publicacion=<?php echo $id_publicacion ?>"><img
        src="../../publico/img/iconos/like_regular.png" /></a>
    <?php

  }

  echo cantidadLikesPublicacion($id_publicacion);

}

function cantidadLikesPublicacion($id_publicacion)
{

  include("../modelo/conexion.php");

  $query = "SELECT * FROM t_likes WHERE id_publicacion = '$id_publicacion'";

  $res = mysqli_query($con, $query);

  return mysqli_num_rows($res);

}
// FIN - FUNCIONES DE LIKE

// INICIO - FUNCIONES DE GUARDAR PUBLICACION
function guardar($id_publicacion)
{

  include("../modelo/conexion.php");

  $id_usuario = $_SESSION["id_usuario"];

  $query = "SELECT * FROM t_guardados WHERE id_usuario = '$id_usuario' AND id_publicacion = '$id_publicacion'";

  $lo_guardo = mysqli_num_rows(mysqli_query($con, $query));

  if ($lo_guardo) {

    ?><a href="../controlador/guardar_publicacion.php?id_publicacion=<?php echo $id_publicacion ?>"><img
        src="../../publico/img/iconos/guardar_solido.png" /></a>
    <?php

  } else {

    ?><a href="../controlador/guardar_publicacion.php?id_publicacion=<?php echo $id_publicacion ?>"><img
        src="../../publico/img/iconos/guardar_regular.png" /></a>
    <?php

  }

}
// FIN - GUARDAR PUBLICACION

// INICIO - FUNCIONES COMENTARIOS
function traerComentarios($query)
{

  include("../modelo/conexion.php");

  $res = mysqli_query($con, $query);

  if (mysqli_num_rows($res) > 0) {
    ?>
    <ul>
      <?php while ($fila = mysqli_fetch_array($res)) { ?>
        <li>
          <img src="<?php echo $fila["foto_perfil"]; ?>" width="20px" alt="Foto de perfil">

          <a href="perfil.php?id_usuario=<?php echo $fila["id_usuario"]; ?>"><?php echo $fila["usuario"]; ?></a>

          <p>
            <?php echo $fila["texto"]; ?>
          </p>

          <?php likeComentario($fila["id_comentario"], $fila["id_publicacion"]); ?>
        </li>
      <?php } ?>
    </ul>
    <?php
  }
}

function cantidadComentarios($id_publicacion)
{
  include("../modelo/conexion.php");

  $query = "SELECT * FROM t_comentarios WHERE id_publicacion = '$id_publicacion'";

  $res = mysqli_query($con, $query);

  return mysqli_num_rows($res);
}

function likeComentario($id_comentario, $id_publicacion)
{
  include("../modelo/conexion.php");

  $id_usuario = $_SESSION["id_usuario"];

  $query = "SELECT * FROM t_likes WHERE id_usuario = '$id_usuario' AND id_comentario = '$id_comentario'";

  $dio_like = mysqli_num_rows(mysqli_query($con, $query));

  if ($dio_like) {
    ?>
    <a
      href="../controlador/like.php?id_comentario=<?php echo $id_comentario ?>&id_publicacion_c=<?php echo $id_publicacion; ?>"><img
        src="../../publico/img/iconos/like_solido.png" /></a>
    <?php

  } else {

    ?><a
      href="../controlador/like.php?id_comentario=<?php echo $id_comentario ?>&id_publicacion_c=<?php echo $id_publicacion; ?>"><img
        src="../../publico/img/iconos/like_regular.png" /></a>
    <?php

  }

  echo cantidadLikesComentario($id_comentario);

}

function cantidadLikesComentario($id_comentario)
{

  include("../modelo/conexion.php");

  $query = "SELECT * FROM t_likes WHERE id_comentario = '$id_comentario'";

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