<?php
require("../modelo/conexion.php");
require("../ayudas/funciones.php");
session_start();

$id_usuario = $_SESSION["id_usuario"];

// VALIDACIÓN - SI EXISTE EL USUARIO

if (empty($_SESSION["usuario"])) {
  header("location: ../../");
}
define("FOTO_PERFIL", "../../publico/img/foto_perfil/");
define("FOTO_PORTADA", "../../publico/img/foto_portada/");
?>

<header>

  <nav class="navegacion">
    <input type="search" name="busqueda" class="buscador" placeholder="Buscar...">
    <div class="logo">
      <a href="inicio.php">BeatCore</a>
    </div>
    <ul class="nav-lista">
      <li class="nav-lista-item">
        <!-- NOTIFICACIONES -->
        <a href="#">
        <i class='bx bxs-bell'></i>
        </a>
      </li>
      <li class="nav-lista-item">
        <!-- CHATS -->
        <a href="#">
        <i class='bx bx-chat'></i>
        </a>
      </li>
      <li class="nav-lista-item item-perfil">
        <!-- LINK AL PERFIL DEL USUARIO -->
        <a href="perfil.php?id_usuario=<?php echo $id_usuario; ?>">
          <img src="<?= FOTO_PERFIL . datosUsuario($id_usuario, "foto_perfil")["foto_perfil"]; ?>">
        </a>
        <!-- FIN - LINK AL PERFIL -->
      </li>
      <!-- TRES PUNTOS (COMO LA HAMBURGUESITA) -->
      <li class="nav-lista-item">
        <a href="#">
        <i class='bx bx-menu'></i>
        </a>
      </li>
      <ul class="lista-menu">
        <li>Modo oscuro</li>
        <li><a href="#">Soporte</a></li>
        <li><a href="#">Reportar</a></li>
        <li><a href="#">Configuración</a></li>
      </ul>
      <!-- FIN - TRES PUNTOS -->
    </ul>
  </nav>

</header>