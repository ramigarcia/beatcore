<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  include("../modelo/conexion.php");
  $query = "SELECT * FROM t_publicaciones ";
  $res = mysqli_query($con, $query);

  if (mysqli_num_rows($res) > 0) {
    ?>
    <ul>
      <?php
      while ($fila = mysqli_fetch_array($res)) {
        ?>
        <li>
          <div class="carta-publi">

            <div class="publicacion-contenido">

              <p>
                <?php echo $fila["texto"]; ?>
              </p>

            </div>

            <a href="publicacion.php?id_publicacion=<?php echo $fila["id_publicacion"]; ?>"><i
                class='bx bx-message-square-dots'></i></a>

            <?php // likesPublicacion($fila["id_publicacion"]); 
                $id_p = $fila["id_publicacion"]
                  ?>
            <button class='btn-like' onclick='like( <?php echo $fila["id_publicacion"]; ?> )'>Like</button>
          </div>

        </li>

        <?php

      }

      ?>
    </ul>
    <?php

  } else {

    echo "No hay publicaciones";

  }

  ?>

  <script>
    function like(id_p) {
      const response = fetch(`like.php/?id_usuario=${id_p}`)
        .then((response) => response.json())
        .then((data) => console.log(data))
    }
  </script>

</body>

</html>