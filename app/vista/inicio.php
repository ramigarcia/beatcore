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
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="../publico/css/modal.css">
  <!-- META PROPS -->
</head>

<body>
  <?php
  // HEADER
  include("../componentes/header.php");

  if (empty($_SESSION["usuario"])) {
    header("location: ../../");
  }
  ?>
  <div class="wrapper">
    <?php include("../componentes/sidebar.php"); ?>
    <?php
    $query = "SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario ORDER BY id_publicacion DESC";
    ?>
    <div class="publicaciones">
      <div class="nueva-publi">
        <!-- VENTANA MODAL -->
        <div class="div-contenedor-modal">
          <div class="div-contenido-modal">

            <form id="form_nueva_publicacion" action="../controlador/publicar.php" method="post">
              <!-- <legend>Nueva publicación</legend> -->
              <label for="texto" class="label">
                <!-- <span>Texto</span> -->
                <textarea name="texto" id="texto" maxlength="300" placeholder="Escribe aquí lo que quieres expresar"
                  required autofocus></textarea>
              </label>
              <input type="submit" name="btn_publicar" id="btn_publicar" onsubmit="this.disabled=true;" hidden>
            </form>

            <div class="div-btn-modal">
              <label for="btn-modal" class="btn-cancelar">Cancelar</label>
              <label for="btn_publicar" class="btn-modal">Publicar</label>
            </div>
          </div>
          <label for="btn-modal" class="cerrar-modal-fondo"></label>
        </div>
        <!-- FIN VENTANA MODAL -->
      </div>
      <h2>Publicaciones</h2>
      <main>
        <?php traerPublicaciones($query); ?>
      </main>
    </div>
  </div>
</body>

</html>