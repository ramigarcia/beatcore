<!DOCTYPE html>
<html lang="en">
<!-- HEAD -->
<?php
include("../componentes/head.php");
?>

<body>
  <?php
  include("../componentes/header.php");

  if (empty($_SESSION["usuario"])) {
    header("location: ../../");
  }

  include("../componentes/sidebar.php");

  $id_usuario = $_SESSION["id_usuario"];

  $fila = datosUsuario($id_usuario, "*");

  ?>

  <form action="../controlador/editar_usuario.php" method="POST" enctype="multipart/form-data">

    <label for="foto_perfil">

        <span>Foto de perfil</span>

        <input type="file" name="foto_perfil" id="foto_perfil">

    </label>

    <label for="foto_portada">

        <span>Foto de portada</span>

        <input type="file" name="foto_portada" id="foto_portada">

    </label>

    <label for="usuario">

        <span>Usuario</span>

        <input type="text" name="usuario" id="usuario" value="<?= $fila["usuario"] ?>">

    </label>

    <label for="nombre">

        <span>Nombre</span>

        <input type="text" name="nombre" id="nombre" value="<?= $fila["nombre"] ?>">

    </label>

    <label for="apellido">

        <span>Apellido</span>

        <input type="text" name="apellido" id="apellido" value="<?= $fila["apellido"] ?>">

    </label>

    <label for="descr">

        <span>Descripción</span>

        <textarea name="descr" id="descr"><?= $fila["descripcion"] ?></textarea>

    </label>

    <input type="submit" name="btn_editar" value="Guardar cambios">

  </form>