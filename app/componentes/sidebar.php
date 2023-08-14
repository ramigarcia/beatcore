<div class="sidebar">

  <a href="inicio.php">Inicio</a>

  <a href="#">Torneos</a>

  <a href="#">Videollamadas</a>

  <!-- INICIO MODAL - NUEVA PUBLICACIÓN -->

  <!-- BOTON MODAL -->

  <div class="div-btn-modal">

    <label for="btn-modal" class="btn-modal">Nueva publicación</label>

  </div>

  <!-- FIN BOTÓN MODAL -->

  <!-- VENTANA MODAL -->

  <input type="checkbox" id="btn-modal">

  <div class="div-contenedor-modal">

    <div class="div-contenido-modal">

      <h2>Nueva publicación</h2>

      <form id="form_nueva_publicacion" action="../controlador/publicar.php" method="post">

        <label for="texto" class="label">

          <span>Texto</span>

          <textarea name="texto" id="texto" maxlength="300" placeholder="Escribe aquí lo que quieres expresar" required
            autofocus></textarea>

        </label>

        <input type="submit" name="btn_publicar" id="btn_publicar" hidden>

      </form>

      <div class="div-btn-modal">

        <label for="btn-modal" class="btn-cancelar">Cancelar</label>

        <label for="btn_publicar" class="btn-modal">Publicar</label>

      </div>

    </div>

    <label for="btn-modal" class="cerrar-modal-fondo"></label>

  </div>

  <!-- FIN VENTANA MODAL -->

  <!-- FIN MODAL - NUEVA PUBLICACIÓN -->

</div>