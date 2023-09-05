<?php

$servidor = "localhost";

// HOSTING DE SOSA
// $usuario = "u761283263_beatcore";

// $clave = "Beatcore2023";

// $db_name = "u761283263_beatcore";

// LOCAL
$usuario = "root";

$clave = "";

$db_name = "beatcore";

$con = mysqli_connect(
  "$servidor",
  // Nombre de usuario
  "$usuario",
  // Contrasenia
  "$clave",
  // Nombre de base de datos
  "$db_name"
);


?>