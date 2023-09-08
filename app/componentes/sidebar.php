<div class="sidebar">
  <ul class="sidebar-lista">
    <li class="sidebar-lista-item">
      <a href="inicio.php">Inicio</a>
    </li>
    <li class="sidebar-lista-item">
      <a href="#">Torneos</a>
    </li>
    <li class="sidebar-lista-item">
      <a href="#">Videollamadas</a>
    </li>
    <li class="sidebar-lista-item">
      <a href="guardado.php">Guardado</a>
    </li>
    <li class="sidebar-lista-item">
      <a href="editar_perfil.php">Editar perfil</a>
    </li>
    <li class="sidebar-lista-item">
      <a href="../controlador/cerrar_sesion.php">Cerrar sesión</a>
    </li>
    <!-- <button id="btn-nueva-publi" class="btn-nueva-publi">Nuva publicación</button> -->
  </ul>
  <!-- INICIO MODAL - NUEVA PUBLICACIÓN -->

  <!-- BOTON MODAL -->
  <!-- <div class="div-btn-modal">
    <label for="btn-modal" class="btn-modal">Nueva publicación</label>
  </div> -->

  <!-- FIN BOTÓN MODAL -->
  <!-- <input type="checkbox" id="btn-modal"> -->

  <!-- FIN MODAL - NUEVA PUBLICACIÓN -->

  <!-- PERFILES SEGUIDOS -->

  <!-- <?php

  // $id_usuario = $_SESSION["id_usuario"];
  
  // $query = "SELECT * FROM t_seguidores INNER JOIN t_usuarios ON t_seguidores.id_seguido = t_usuarios.id_usuario WHERE id_seguidor = '$id_usuario' ORDER BY id_seguimiento DESC LIMIT 3";
  
  // $res = mysqli_query($con, $query);
  
  // if (mysqli_num_rows($res) > 0) {
  ?>
    <p>Seguido</p>
    <?php

    // while ($fila = mysqli_fetch_array($res)) {
    ?>
      <ul>
        <li>
          <img src="<?php //echo $fila["foto_perfil"]; ?>" width="20px" alt="Foto de perfil">
          <a href="perfil.php?id_usuario=<?php // echo $fila["id_usuario"]; ?>"><?php //echo $fila["usuario"]; ?></a>
        </li>
      </ul>
      <?php
      //   }
      // }
      ?> -->


  <!-- PERFILES RECOMENDADOS -->

  <?php
  // $query = "SELECT id_usuario, usuario, foto_perfil FROM t_usuarios WHERE id_usuario != '$id_usuario' ORDER BY id_usuario DESC LIMIT 3";
  
  // $res = mysqli_query($con, $query);
  
  // if (mysqli_num_rows($res) > 0):
  ?>
  <!-- <p>Perfiles recomendados</p> -->
  <?php
  // while ($fila = mysqli_fetch_array($res)) {
  ?>
  <!-- <ul>
        <li> -->
  <!-- <img src="<?php // echo $fila["foto_perfil"]; ?>" width="20px" alt="Foto de perfil">
          <a href="perfil.php?id_usuario=<?php // echo $fila["id_usuario"]; ?>"><?php // echo $fila["usuario"]; ?></a> -->
  <!-- </li>
      </ul> -->
  <?php
  // }
  // endif;
  ?>

</div>