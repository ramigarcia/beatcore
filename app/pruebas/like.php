<?php
// require('../modelo/conexion.php');
// $query = "SELECT * FROM t_usuarios";

// $res = mysqli_query($con, $query);

// while ($fila = mysqli_fetch_array($res)) {
//   json_encode([
//     "id" => $fila['id_usuario'],
//     "usuario" => $fila['usuario']
//   ]);
// }


if (isset($_GET["id_usuario"]) && isset($_GET["nombre"])) {
  $phpVar1 = $_GET["id_usuario"];
  $phpVar2 = $_GET["nombre"];

  echo json_encode([
    "id" => $phpVar1,
    "nombre" => $phpVar2
  ]);
} else {
  echo json_encode([
    "<p>Error</p>"
  ]);
}