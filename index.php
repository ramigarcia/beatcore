<?php 

    include("includes/head.html");

    include("includes/header.php");

    session_start();

    // if(isset($_SESSION["usuario"])){

    //     header("location: vista/inicio.php");

    // }
    
?>

    <h1>BeatCore - Landing page</h1>

    <p>La primer red social para Beatboxers</p>
    
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam laudantium illum earum ex est possimus sint voluptatem mollitia modi quo, dolorum velit perferendis quod, quas beatae at accusantium tenetur tempore.</p>

<?php include("includes/footer.html"); ?>

<!-- NORMAS DE CODIFICACIÓN:

BASE DE DATOS:

    Tablas: t_nombre ("t" de tabla + "_" + nombre de la tabla en plural)

    Id's: id_nombre ("id" + "_" + nombre de la tabla en singular)

CÓDIGO:

    variables: snake_case

    funciones: camelCase

OTRAS CUESTIONES:

    espacios: Siempre dejo un espacio entre líena y línea (dos enters) para hacer el código más legible.

    idioma: Todo el proyecto (variable, funciones, archivos, textos, carpetas y demás) va a ser escrito en español. Está PROHIBIDO usar palabras en inglés.

    contraseña: para evitar el uso de la "ñ" en la base de datos, variables y demás, a partir de ahora vamos a llamarle a este campo "clave".

    diseño: POR FAVOR, NO APLICARLE DISEÑO A NADA... se que es algo complicado para vos Rami, pero te pido por favorr, que te enfoques única y exclusivamente en el funcionamiento de la página porque es lo que más nos están pidiendo.

    box-icons
    
-->