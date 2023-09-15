<?php

function traerPublicaciones($query)
{
  include("../modelo/conexion.php");

  $res = mysqli_query($con, $query);

  if (mysqli_num_rows($res) > 0) {
    ?>
    <ul>
      <?php
      while ($fila = mysqli_fetch_array($res)) {
        ?>
        <li>
          <div class="carta-publi">

            <div class="usuario">
              <div class="img-perfil">
                <img class="img-publi-perfil" src="<?= FOTO_PERFIL . $fila["foto_perfil"] ?>" alt="Foto de perfil" />
              </div>

              <a href="perfil.php?id_usuario=<?php echo $fila["id_usuario"]; ?>"><?php echo $fila["usuario"]; ?></a>
            </div>

            <div class="publicacion-contenido">

              <p>
                <?php echo $fila["texto"]; ?>
              </p>

            </div>
            <div class="publicacion-actions">
              <div class="respuesta">
                <?php publicacionRespuesta($fila["id_publicacion"]); ?>
              </div>

              <div class="guardar">
                <?php guardar($fila["id_publicacion"]); ?>
              </div>

              <div class="responder">
                <a href="responder.php?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><i
                    class='bx bx-share bx-rotate-180'></i></a>
                <?php echo cantidadRespuestas($fila["id_publicacion"]); ?>
              </div>

              <div class="comentarios">
                <a href="publicacion.php?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><i
                    class='bx bx-message-square-dots'></i></a>

                <?php echo cantidadComentariosPublicacion($fila["id_publicacion"]); ?>
              </div>

              <div class="like">
                <?php likesPublicacion($fila["id_publicacion"]); ?>
              </div>

              <div class="eliminar">
                <?php
                if ($fila["id_usuario"] == $_SESSION["id_usuario"]) {

                  ?><a
                    href="../controlador/eliminar_publicacion.php?id_publicacion=<?= $fila["id_publicacion"] ?>">Eliminar</a>
                  <?php

                }

                ?>
              </div>
            </div>
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
// PUBLICACION - RESPUESTA
function publicacionRespuesta($id_publicacion)
{
  // EN CASO DE QUE LA PUBLICACIÓN SEA UNA RESPUESTA, MOSTRALA
  include("../modelo/conexion.php");

  $query = "SELECT * FROM t_publicaciones WHERE id_publicacion = '$id_publicacion'";
  $res = mysqli_fetch_array(mysqli_query($con, $query));

  if ($res["id_respuesta"] != NULL) {
    $id_respuesta = $res["id_respuesta"];
    $query = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario WHERE id_publicacion = '$id_respuesta'";
    $res = mysqli_fetch_array(mysqli_query($con, $query));
    ?>
    <div>
      <img src="<?= FOTO_PERFIL . $res["foto_perfil"] ?>" width="20px" height="20px">
      <a href="perfil.php?id_usuario=<?= $res["id_usuario"] ?>"><?= $res["usuario"]; ?></a>
      <p>
        <?= $res["texto"]; ?>
      </p>
    </div>
    <?php
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
    ?><a href="../controlador/like.php?id_publicacion=<?php echo $id_publicacion ?>"><i class='bx bxs-like'></i></a>
    <?php
  } else {
    ?><a href="../controlador/like.php?id_publicacion=<?php echo $id_publicacion ?>"><i class='bx bx-like'></i></a>
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

    ?><a href="../controlador/guardar_publicacion.php?id_publicacion=<?php echo $id_publicacion ?>"><i
        class='bx bxs-save'></i></a>
    <?php

  } else {

    ?><a href="../controlador/guardar_publicacion.php?id_publicacion=<?php echo $id_publicacion ?>"><i
        class='bx bx-save'></i></a>
    <?php

  }

}
// FIN - GUARDAR PUBLICACION

// INICIO - FUNCIONES COMENTARIOS
function mostrarComentarios($query)
{

  include("../modelo/conexion.php");

  $res = mysqli_query($con, $query);

  if (mysqli_num_rows($res) > 0) {
    ?>
    <ul>
      <?php while ($fila = mysqli_fetch_array($res)) { ?>
        <li>
          <img src="<?= FOTO_PERFIL . $fila["foto_perfil"] ?>" width="20px" alt="Foto de perfil">

          <a href="perfil.php?id_usuario=<?php echo $fila["id_usuario"]; ?>"><?php echo $fila["usuario"]; ?></a>

          <p>
            <?php echo $fila["texto"]; ?>
          </p>

          <?php

          $datos = datosComentario($fila["id_comentario"]);

          if ($datos["id_respuesta"] == NULL) {

            ?>

            <a href="comentario.php?id_comentario=<?= $fila["id_comentario"] ?>"><img
                src="../../publico/img/iconos/comentar.png"></a>

            <?php

            echo cantidadRespuestasComentario($fila["id_comentario"]);

          }

          ?>

          <?php likeComentario($fila["id_comentario"], $fila["id_publicacion"]); ?>
        </li>
      <?php } ?>
    </ul>
    <?php
  }
}

function cantidadComentariosPublicacion($id_publicacion)
{
  // FUNCION PARA RETORNAR LA CANTIDAD DE COMENTARIOS QUE TIENE UNA PUBLICACION
  include("../modelo/conexion.php");

  $query = "SELECT * FROM t_comentarios WHERE id_publicacion = '$id_publicacion'";

  $res = mysqli_query($con, $query);

  return mysqli_num_rows($res);
}

function cantidadRespuestasComentario($id_comentario)
{
  // FUNCION PARA RETORNAR LA CANTIDAD DE RESPUESTAS QUE TIENE UN COMENTARIO
  include("../modelo/conexion.php");

  $query = "SELECT * FROM t_comentarios WHERE id_respuesta = '$id_comentario'";

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

function datosComentario($id_comentario)
{

  include("../modelo/conexion.php");

  $query = "SELECT * FROM t_comentarios INNER JOIN t_usuarios ON t_comentarios.id_usuario = t_usuarios.id_usuario WHERE id_comentario = '$id_comentario'";

  $datos = mysqli_fetch_array(mysqli_query($con, $query));

  return $datos;

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