<?php
require("../modelo/conexion.php");
require("../ayudas/funciones.php");
session_start();

$id_usuario = $_SESSION["id_usuario"];

// VALIDACIÓN - SI EXISTE EL USUARIO

if (empty($_SESSION["usuario"])) {

  header("location: ../../");

}

?>

<header>

  <a href="inicio.php">BeatCore</a>

  <input type="search" name="busqueda">

  <a href="#">Notificaciones</a>

  <a href="#">Chats</a>

  <!-- LINK AL PERFIL DEL USUARIO -->

    <a href="perfil.php?id_usuario=<?php echo $id_usuario; ?>"><img src="<?php echo datosUsuario($id_usuario, "foto_perfil")["foto_perfil"]; ?>" width="20px"></a>

  <!-- FIN - LINK AL PERFIL -->

  <!-- TRES PUNTOS (COMO LA HAMBURGUESITA) -->

    <a href="#"><img src="../../publico/img/iconos/tres_puntos.png" width="20px"></a>

    <ul>

      <li><a href="#">Soporte</a></li>

      <li>Modo oscuro</li>

      <li><a href="../controlador/cerrar_sesion.php">Cerrar sesión</a></li>

    </ul>

  <!-- FIN - TRES PUNTOS -->

</header>