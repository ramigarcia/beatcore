<?php

require("../modelo/conexion.php");

session_start();

$id_usuario = $_SESSION["id_usuario"];

if (empty($_SESSION["usuario"])) {

  header("location: ../../");

}

// FUNCIONES

function traerPublicaciones($query)
{

  require("../modelo/conexion.php");

  $res = mysqli_query($con, $query);

  if (mysqli_num_rows($res) > 0) {

    while ($fila = mysqli_fetch_array($res)) {

      ?>

      <div class="publicacion">

        <!-- <img src="<?php //echo $fila["foto_perfil"]; ?>" width="20px" alt="foto de perfil" /> -->
        <img src="../../publico/img/foto_perfil/por_defecto.png" width="20px" alt="foto de perfil" />

        <a href="perfil.php?id_usuario=<?php echo $fila["id_usuario"]; ?>"><?php echo $fila["usuario"]; ?></a>

        <div class="publicacion-contenido">

          <p>
            <?php echo $fila["texto"]; ?>
          </p>

        </div>

        <a href="#"><img src="../../publico/img/iconos/compartir.png" /></a>

        <a href="#"><img src="../../publico/img/iconos/responder.png" /></a>

        <a href="#"><img src="../../publico/img/iconos/guardar_regular.png" /></a>

        <a href="#"><img src="../../publico/img/iconos/comentar.png" /></a>

        <a href="#"><img src="../../publico/img/iconos/like_regular.png" /></a>

      </div>

      <?php

    }

  } else {

    echo "No hay publicaciones";

  }

}

?>

<header>

  <a href="inicio.php">BeatCore</a>

  <input type="search" name="busqueda">

  <a href="#">Notificaciones</a>

  <a href="#">Chats</a>

  <a href="perfil.php?id_usuario=<?php echo $id_usuario; ?>"><img src="../../publico/img/iconos/perfil.png"
      width="20px" /></a>

  <a href="#">...</a>

  <ul>

    <li><a href="#">Soporte</a></li>

    <li>Modo oscuro</li>

    <li><a href="../controlador/cerrar_sesion.php">Cerrar sesión</a></li>

  </ul>

</header>