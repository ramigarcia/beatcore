<!DOCTYPE html>
<html lang="es">
<!-- HEAD -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeatCore</title>
  <!-- CDN - BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- ESTILOS -->
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/editar_perfil.css">
  <!-- META PROPS -->
</head>

<body>
  <?php include("../componentes/header.php"); ?>
  <div class="wrapper">
    <?php
    if (empty($_SESSION["usuario"])) {
      header("location: ../../");
    }

    include("../componentes/sidebar.php");

    $id_usuario = $_SESSION["id_usuario"];

    $fila = datosUsuario($id_usuario, "*");

    if (isset($_POST["btn_editar"])) {

      $id_usuario = $_SESSION["id_usuario"];
    
      $fotos_usuario = datosUsuario($id_usuario, "foto_perfil, foto_portada", );
    
      // Crear la carpeta del usuario en caso de que no exista
      $url = $_SERVER["DOCUMENT_ROOT"] ."/BeatCore/publico/usuarios/". $_SESSION["id_usuario"] ."/";
      if(!file_exists($url)){
    
        mkdir($url);
    
        mkdir($url ."foto_perfil/");
    
        mkdir($url ."foto_portada/");
    
      }
    
      if ($_FILES["foto_perfil"]["name"] == "") {
    
        $foto_perfil = $fotos_usuario["foto_perfil"];
    
      } else {
        $foto_perfil = uniqid() . $_FILES["foto_perfil"]["name"];
    
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $url ."foto_perfil/". $foto_perfil);
      }
    
      if ($_FILES["foto_portada"]["name"] == "") {
    
        $foto_portada = $fotos_usuario["foto_portada"];
    
      } else {
    
        $foto_portada = uniqid() . $_FILES["foto_portada"]["name"];
    
        move_uploaded_file($_FILES['foto_portada']['tmp_name'], $url ."foto_portada/". $foto_portada);
    
      }
    
      $usuario = $_POST["usuario"];
    
      $nombre = $_POST["nombre"];
    
      $apellido = $_POST["apellido"];
    
      $descr = $_POST["descr"];
    
      $query = "UPDATE t_usuarios SET foto_perfil = '$foto_perfil', foto_portada = '$foto_portada', usuario = '$usuario', nombre = '$nombre', apellido = '$apellido', descripcion = '$descr' WHERE id_usuario = '$id_usuario'";
    
      $res = mysqli_query($con, $query);
    
      if($res){
        header("Location: perfil.php?id_usuario=" . $id_usuario);
      }
    
    }

    ?>
    <div class="edit-perfil">
      <main>
        <form action="editar_perfil.php" method="POST" enctype="multipart/form-data">

          <label for="foto_perfil" class="label-foto-perfil">
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
      </main>
    </div>
  </div>

</body>

</html>