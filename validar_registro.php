<?php

if(isset($_POST["btn_registrar_usuario"])){

    // RECIBIMOS TODOS LOS CAMPOS
    $usuario = $_POST["usuario"];
    $gmail = $_POST["gmail"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $clave = $_POST["clave"];
    $rep_clave = $_POST["rep_clave"];

    // FILTRAMOS LOS DATOS
    $usuario = htmlentities($usuario);
    $gmail = htmlentities($gmail);

    $valido = true;

    // VALIDAMOS QUE LOS CAMPOS NO ESTÉN VACÍOS
    if(empty($usuario) OR empty($gmail) OR empty($fecha_nacimiento) OR empty($clave) OR empty($rep_clave)){

        echo "<p>Rellene todos los campos</p>";
        $valido = false;
        
    }else{

        // VALIDAR USUARIO
        if(strlen($usuario) < 3){
            echo "Introduzca un nombre de usuario más largo";
            $valido = false;
        }

        //Caracteres no admitidos
        $no_admitido = ["<", ">", "!", "¡", "?", "¿", "°", "|", "*", "+", "-", "/", "\\", "$", "#", "%", "&", "(", ")","=", "[", "]", "{", "}", "@", "¬", "^", "`", "~"];
        $msj_caracteres = false;
        for($i = 0; $i < strlen($usuario); $i++){
            if(in_array($usuario[$i], $no_admitido)){
                $msj_caracteres = true;
                $valido = false;
            }
        }
        if($msj_caracteres) echo 'Sólo se admite "_", "-" y "." como carácteres especiales';

        // Si el usuario ya existe
        $stmt = mysqli_prepare($con, "SELECT usuario FROM t_usuarios WHERE usuario = ?");
        mysqli_stmt_bind_param($stmt, "s", $usuario);
        mysqli_stmt_execute($stmt);
        if(mysqli_stmt_fetch($stmt) != NULL){
            echo "<p>Ese nombre de usuario ya está en uso, escoja otro</p>";
            $valido = false;
        }
        mysqli_stmt_close($stmt);
        // FIN VALIDAR USUARIO


        // GMAIL
        if(!filter_var($gmail, FILTER_VALIDATE_EMAIL)){
            echo "<p>Introduzca un correo válido</p>";
            $valido = false;
        }
        // Si el gmail ya está en uso
        $stmt = mysqli_prepare($con, "SELECT gmail FROM t_usuarios WHERE gmail = ?");
        mysqli_stmt_bind_param($stmt, "s", $gmail);
        mysqli_stmt_execute($stmt);
        if(mysqli_stmt_fetch($stmt) != NULL){
            echo "<p>Ese gmail ya está en uso, escoja otro</p>";
            $valido = false;
        }
        mysqli_stmt_close($stmt);
    
        // CALCULAMOS LA EDAD
        list($ano,$mes,$dia) = explode("-",$fecha_nacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if($mes_diferencia <= 0 AND $dia_diferencia < 0) $ano_diferencia --;
    
        if($ano_diferencia < 13){
            echo "<p>Eres muy pequeño/a para tener una cuenta</p>";
            $valido = false;
        }

        // CONTRASEÑA
        if(strlen($clave) < 8){
            echo "<p>Introduzca una contraseña con 8 o más caracteres</p>";
            $valido = false;
        }
        if($clave != $rep_clave){
            echo "<p>Las contraseñas no coinciden</p>";
            $valido = false;
        }
    
        // TÉRMINOS Y CONDICIONES
        if(empty($_POST["terminos_condiciones"])){
    
            echo "<p>Acepte los términos y condiciones</p>";
            $valido = false;
    
        }

    }
}

?>