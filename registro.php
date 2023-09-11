<?php require("app/modelo/conexion.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeatCore</title>
  <!-- CDN BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- ESTILOS -->
  <link rel="stylesheet" href="./css/main.css">
  <!-- META PROPS -->
</head>

<body>
  <header>
    <nav class="navigation">
      <div class="logo">
        <a href="index.php">BeatCore</a>
      </div>
      <ul class="navigation-list">
        <li class="navigation-list-item">
          <a href="login.php">Iniciar Sesión</a>
        </li>
        <li class="navigation-list-item">
          <a href="registro.php">Registrarse</a>
        </li>
      </ul>
    </nav>
  </header>
  <?php
  function mostrarSiExiste($name)
  {
    if (isset($_POST["$name"])) {
      echo $_POST["$name"];
    }
  }
  session_start();
  ?>
  <!-- FORMULARIOS -->
  <div class="container">
    <?php if(isset($_SESSION["id_usuario"])){ header("Location: app/vista/inicio.php"); ?>
    <!-- <form action="registro.php" method="POST" enctype="multipart/form-data">
      <legend><?php//"Bienvenido ". $_SESSION["usuario"]?></legend>
      <label for="foto_perfil">
        <span>Seleccionar foto de perfil</span>
        <input type="file" name="foto_perfil" id="foto_perfil" hidden>
        <label for="foto_perfil"><img src="publico/img/foto_perfil/<?php//$_SESSION["foto_perfil"]?>"></label>
      </label>
      <button type="button"><a href="app/vista/inicio.php">Omitir</a></button>
      <button type="submit" name="btn_foto_perfil">Siguiente</button> -->
    </form>
    <?php }else{ ?>
      <!-- REGISTRARSE - PASO UNO -->
    <form action="registro.php" method="POST">
      <legend>Registrar usuario</legend>

      <!-- VALIDACIÓN -->
      <?php include("validar_registro.php"); ?>

      <label for="usuario">
        <span>Usuario</span>
        <input type="text" value="<?php mostrarSiExiste("usuario"); ?>" name="usuario" id="usuario" autofocus>
      </label>

      <label for="gmail">
        <span>Gmail</span>
        <input type="email" value="<?php mostrarSiExiste("gmail"); ?>" name="gmail" id="gmail">
      </label>

      <label for="fecha_nacimiento">
        <span>Fecha de nacimiento</span>
        <input type="date" value="<?php mostrarSiExiste("fecha_nacimiento"); ?>" name="fecha_nacimiento"
          id="fecha_nacimiento">
      </label>

      <label for="clave">
        <span>Contraseña</span>
        <input type="password" name="clave" id="clave" value="<?php mostrarSiExiste("clave"); ?>">
      </label>

      <label for="rep_clave">
        <span>Repetir contraseña</span>
        <input type="password" name="rep_clave" id="rep_clave" value="<?php mostrarSiExiste("rep_clave"); ?>">
      </label>

      <label for="terminos_condiciones" class="terminos">
        <input type="checkbox" name="terminos_condiciones" id="terminos_condiciones" value="1" <?php if(isset($_POST["terminos_condiciones"]) AND !empty($_POST["terminos_condiciones"])){ ?>checked<?php } ?>>
        <span>Acepto los términos y <a href="#">condiciones</a></span>
      </label>

      <button type="submit" name="btn_registrar_usuario">Registrarse</button>
    </form>
    <?php } ?>
  </div>

</body>

</html>

<?php

if(isset($_POST["btn_registrar_usuario"]) AND isset($valido) AND $valido == true){

  $stmt = mysqli_prepare($con, "INSERT INTO t_usuarios(usuario, gmail, fecha_nacimiento, clave, id_rol, fecha_creacion) VALUES(?, ?, ?, ?, 1 , now())");

  mysqli_stmt_bind_param($stmt, "ssss", $usuario, $gmail, $fecha_nacimiento, $clave);

  if(mysqli_stmt_execute($stmt)){

    mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($con, "SELECT id_usuario, usuario, id_rol FROM t_usuarios WHERE id_usuario = ?");

    $id = mysqli_insert_id($con);

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $id_usuario, $usuario, $id_rol);

    if(mysqli_stmt_fetch($stmt)){

      $_SESSION["id_usuario"] = $id_usuario;

      $_SESSION["usuario"] = $usuario;

      $_SESSION["id_rol"] = $id_rol;

      mysqli_stmt_close($stmt);

      // DEFINIR UNA FOTO DE PERFIL Y DE PORTADA POR DEFAULT
      $stmt = mysqli_prepare($con, "UPDATE t_usuarios SET foto_perfil = ?, foto_portada = ? WHERE id_usuario = ?");

      mysqli_stmt_bind_param($stmt, "ssi", $foto_perfil, $foto_portada, $_SESSION["id_usuario"]);

      $foto_perfil = "foto_per_us". $_SESSION["id_usuario"] .".png";

      $foto_portada = "foto_por_us". $_SESSION["id_usuario"] .".png";

      if(mysqli_stmt_execute($stmt)){

        mysqli_stmt_close($stmt);

        // Muevo la foto de perfil y portada por defecto a sus respectivas carpetas
        $archivo = $_SERVER["DOCUMENT_ROOT"] ."/beatcore/publico/img/por_defecto/foto_perfil.png";
        $destino = $_SERVER["DOCUMENT_ROOT"] ."/beatcore/publico/img/foto_perfil/". $foto_perfil;

        if(!copy($archivo, $destino)){
          echo "Error al copiar $archivo";
        }

        // Asignar una foto de portada por defecto
        $archivo = $_SERVER["DOCUMENT_ROOT"] ."/beatcore/publico/img/por_defecto/foto_portada.png";
        $destino = $_SERVER["DOCUMENT_ROOT"] ."/beatcore/publico/img/foto_portada/". $foto_portada;

        if(!copy($archivo, $destino)){
          echo "Error al copiar $archivo";
        }

      }

      // GUARDO ESA FOTO DE PERFIL Y DE PORTADA EN LA SESSION
      $_SESSION["foto_perfil"] = $foto_perfil;

      $_SESSION["foto_portada"] = $foto_portada;

      header("Location: app/vista/inicio.php");

    }

  }

}

if(isset($_POST["btn_foto_perfil"])){
  // $foto_perfil = $_POST["foto_perfil"]["name"];
  // echo $foto_perfil;
}