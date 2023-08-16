<?php

require("../modelo/conexion.php");

session_start();

$id_usuario = $_SESSION["id_usuario"];

if (empty($_SESSION["usuario"])) {

  header("location: ../../");

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