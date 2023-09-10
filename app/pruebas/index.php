<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  $html = "
      <div class='publicacion' id='1'>Publicacion 1<br>
        <button class='btn-like' onclick='like()'>Like</button>
      </div>
      ";
  ?>

  <div class="div">
    <?php echo $html; ?>
  </div>

  <script>
    const like = () => {
      const id = 3;
      const name = "tilin";

      const response = fetch(`like.php/?id_usuario=${id}&nombre=${name}`)
        .then((response) => response.json())
        .then((data) => console.log(data))
    }
  </script>

</body>

</html>