<?php

<<<<<<< HEAD

function rellenar($atributo){
=======
function rellenar($atributo)
{
>>>>>>> rami

  include("../modelo/conexion.php");

  if (isset($_POST[$atributo])) {

    echo $_POST[$atributo];

  } else {

    $dato = mysqli_fetch_array(mysqli_query($con, "SELECT $atributo FROM t_usuarios WHERE id_usuario = '$_SESSION[id_usuario]'"))[$atributo];

    if (!empty($dato)) {

      echo $dato;

    }

  }

}

?>

<!DOCTYPE html>
<html lang="es">
<!-- HEAD -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BeatCore</title>
  <!-- CDN - BOXICONS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Nunito:wght@200;300;500&display=swap"
    rel="stylesheet">
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

    $usuario = datosUsuario($_SESSION["id_usuario"], "*");

    ?>
    <div class="edit-perfil">
      <main>
        <form action="editar_perfil.php" method="POST" enctype="multipart/form-data">

          <?php
          // VALIDACIÓN
          if(isset($_POST["btn_editar"])){
            $valido = true;
            if(strlen($_POST["usuario"]) < 3){
              echo "<p>Introduzca un nombre de usuario más largo</p>";
              $valido = false;
            }else if($_POST["usuario"] != $_SESSION["usuario"]){
              $stmt = mysqli_prepare($con, "SELECT usuario FROM t_usuarios WHERE usuario = ?");
              mysqli_stmt_bind_param($stmt, "s", $_POST["usuario"]);
              mysqli_stmt_execute($stmt);
              if(mysqli_stmt_fetch($stmt) != NULL){
                echo "<p>Ese nombre de usuario ya está en uso, escoja otro</p>";
                $valido = false;
              }
            }

            // EXTENSIONES DE LOS ARCHIVOS
            $msj_extension = false;
            $extensiones_validas = ["png", "jpeg", "jpg"];

            if(!empty($_FILES["foto_perfil"]["name"])){
              $extension = pathinfo($_FILES["foto_perfil"]["name"], PATHINFO_EXTENSION);
              if(!in_array($extension, $extensiones_validas)){
                $msj_extension = true;
                $valido = false;
              }
            }

            if(!empty($_FILES["foto_portada"]["name"])){
              $extension = pathinfo($_FILES["foto_portada"]["name"], PATHINFO_EXTENSION);
              if(!in_array($extension, $extensiones_validas)){
                $msj_extension = true;
                $valido = false;
              }
            }
            if($msj_extension) echo "Sólo se admiten imágenes .png y .jpeg";

          }
          ?>

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
            <input type="text" name="usuario" id="usuario" value="<?php rellenar("usuario") ?>">
          </label>

          <label for="nombre">
            <span>Nombre</span>
            <input type="text" name="nombre" id="nombre" value="<?php rellenar("nombre") ?>">
          </label>

          <label for="apellido">
            <span>Apellido</span>
            <input type="text" name="apellido" id="apellido" value="<?php rellenar("apellido") ?>">
          </label>

          <label for="descripcion">
            <span>Descripción</span>
            <textarea name="descripcion" id="descripcion"><?php rellenar("descripcion") ?></textarea>
          </label>

          <input type="submit" name="btn_editar" value="Guardar cambios" onsubmit="this.disabled=true;">
        </form>
      </main>
    
    </div>
  </div>

<<<<<<< HEAD
  
=======
  <?php

  if (isset($_POST["btn_editar"])) {

    $url = $_SERVER["DOCUMENT_ROOT"] . "/beatcore/publico/img/";

    if ($_FILES["foto_perfil"]["name"] == "") {

      $foto_perfil = $usuario["foto_perfil"];

    } else {

      $foto_perfil = "us" . $_SESSION["id_usuario"] . "." . pathinfo($_FILES["foto_perfil"]["name"], PATHINFO_EXTENSION);

      if (file_exists($url . "foto_perfil/" . $foto_perfil)) {
        unlink($url . "foto_perfil/" . $foto_perfil);
      }

      move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $url . "foto_perfil/" . $foto_perfil);

    }

    if ($_FILES["foto_portada"]["name"] == "") {

      $foto_portada = $usuario["foto_portada"];

    } else {

      $foto_portada = "us" . $_SESSION["id_usuario"] . "." . pathinfo($_FILES["foto_portada"]["name"], PATHINFO_EXTENSION);

      if (file_exists($url . "foto_portada/" . $foto_portada)) {
        unlink($url . "foto_portada/" . $foto_portada);
      }

      move_uploaded_file($_FILES['foto_portada']['tmp_name'], $url . "foto_portada/" . $foto_portada);

    }

    $usuario = $_POST["usuario"];

    $nombre = $_POST["nombre"];

    $apellido = $_POST["apellido"];

    $descr = $_POST["descripcion"];

    $query = "UPDATE t_usuarios SET foto_perfil = '$foto_perfil', foto_portada = '$foto_portada', usuario = '$usuario', nombre = '$nombre', apellido = '$apellido', descripcion = '$descr' WHERE id_usuario = '$_SESSION[id_usuario]'";

    mysqli_query($con, $query);

    header("location: perfil.php?id_usuario=" . $_SESSION["id_usuario"]);

  }
  ?>

>>>>>>> rami
</body>

</html>
<?php
    if (isset($_POST["btn_editar"]) AND isset($valido) AND $valido == true) {
      $url = $_SERVER["DOCUMENT_ROOT"] ."/beatcore/publico/img/";
    
      if ($_FILES["foto_perfil"]["name"] == "") {
    
        $foto_perfil = $usuario["foto_perfil"];
    
      } else {
    
        $foto_perfil = "us". $_SESSION["id_usuario"] .".". pathinfo($_FILES["foto_perfil"]["name"], PATHINFO_EXTENSION);
    
        if(file_exists($url ."foto_perfil/". $foto_perfil)){
          unlink($url ."foto_perfil/". $foto_perfil);
        }
    
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $url ."foto_perfil/". $foto_perfil);
    
      }
    
      if ($_FILES["foto_portada"]["name"] == "") {
    
        $foto_portada = $usuario["foto_portada"];
    
      } else {
    
        $foto_portada = "us". $_SESSION["id_usuario"] .".". pathinfo($_FILES["foto_portada"]["name"], PATHINFO_EXTENSION);
        
        if(file_exists($url ."foto_portada/". $foto_portada)){
          unlink($url ."foto_portada/". $foto_portada);
        }
    
        move_uploaded_file($_FILES['foto_portada']['tmp_name'], $url ."foto_portada/". $foto_portada);
    
      }
    
      $usuario = $_POST["usuario"];
    
      $nombre = $_POST["nombre"];
    
      $apellido = $_POST["apellido"];
    
      $descr = $_POST["descripcion"];
    
      $query = "UPDATE t_usuarios SET foto_perfil = '$foto_perfil', foto_portada = '$foto_portada', usuario = '$usuario', nombre = '$nombre', apellido = '$apellido', descripcion = '$descr' WHERE id_usuario = '$_SESSION[id_usuario]'";
    
      mysqli_query($con, $query);
      header("Location: perfil.php?id_usuario=". $_SESSION["id_usuario"]);
      }
    ?>