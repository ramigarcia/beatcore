<?php
require("../modelo/conexion.php");
require("../ayudas/funciones.php");
session_start();

$id_usuario = $_SESSION["id_usuario"];

// VALIDACIÓN - SI EXISTE EL USUARIO

if (empty($_SESSION["usuario"])) {
  header("location: ../../");
}
define("URL_USUARIO", "../../publico/usuarios/");
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
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
            style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
            <path
              d="M12 22a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22zm7-7.414V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v4.586l-1.707 1.707A.996.996 0 0 0 3 17v1a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-1a.996.996 0 0 0-.293-.707L19 14.586z">
            </path>
          </svg>
        </a>
      </li>
      <li class="nav-lista-item">
        <!-- CHATS -->
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
            style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
            <path
              d="M5 18v3.766l1.515-.909L11.277 18H16c1.103 0 2-.897 2-2V8c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h1zM4 8h12v8h-5.277L7 18.234V16H4V8z">
            </path>
            <path d="M20 2H8c-1.103 0-2 .897-2 2h12c1.103 0 2 .897 2 2v8c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2z">
            </path>
          </svg>
        </a>
      </li>
      <li class="nav-lista-item item-perfil">
        <!-- LINK AL PERFIL DEL USUARIO -->
        <a href="perfil.php?id_usuario=<?php echo $id_usuario; ?>">
          <img src="<?php echo URL_USUARIO . $id_usuario . '/foto_perfil/' . datosUsuario($id_usuario, "foto_perfil")["foto_perfil"]; ?>"
            width="20px">
        </a>
        <!-- FIN - LINK AL PERFIL -->
      </li>
      <!-- TRES PUNTOS (COMO LA HAMBURGUESITA) -->
      <li class="nav-lista-item">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
            style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
            <path
              d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
            </path>
          </svg>
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