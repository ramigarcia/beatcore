<?php 

    include("includes/head.html");

    include("modelo/conexion.php");
        
    include("includes/header.php"); 

    function mostrarSiExiste($name){

        if(isset($_POST["$name"])){

            echo $_POST["$name"];

        }

    }

    session_start();

    if(isset($_SESSION["usuario"])){

        header("location: vista/inicio.php");

    }
    
?>

    <h1>Registrar usuario</h1>

    <form action="registro.php" method="POST">

        <label for="usuario">

            <span>Usuario</span>

            <input type="text" value="<?php mostrarSiExiste("usuario"); ?>" name="usuario" id="usuario" pattern="[A-Za-z]{3,20}" required autofocus>

        </label>

        <label for="gmail">

            <span>Gmail</span>

            <input type="email" value="<?php mostrarSiExiste("gmail"); ?>" name="gmail" id="gmail" required>

        </label>

        <label for="fecha_nacimiento">

            <span>Fecha de nacimiento</span>

            <input type="date" value="<?php mostrarSiExiste("fecha_nacimiento"); ?>" name="fecha_nacimiento" id="fecha_nacimiento" required>

        </label>

        <label for="clave">

            <span>Contraseña</span>

            <input type="password" name="clave" id="clave" required>

        </label>

        <label for="rep_clave">

            <span>Repetir contraseña</span>

            <input type="password" name="rep_clave" id="rep_clave" required>

        </label>

        <label for="terminos_condiciones">

            <input type="checkbox" name="terminos_condiciones" id="terminos_condiciones" required>

            <span>Acepto los términos y <a href="#">condiciones</a></span>

        </label>

        <p>¿Ya tienes cuenta? <a href="iniciar_sesion.php">¡Inicia sesión!</a></p>

        <button type="submit" name="btn_registrar_usuario">Registrarse</button>

    </form>

    <?php
    
        if(isset($_POST["btn_registrar_usuario"])){

            // OBTENGO LOS DATOS DEL FORMULARIO

            $usuario = $_POST["usuario"];

            $gmail = $_POST["gmail"];

            $fecha_nacimiento = $_POST["fecha_nacimiento"];

            $clave = md5($_POST["clave"]);

            $rep_clave = md5($_POST["rep_clave"]);

            $foto_perfil = "../publico/img/foto_perfil/por_defecto.png";

            $foto_portada = "../publico/img/foto_portada/por_defecto.png";

            // VALIDACIÓN DE LOS CAMPOS

            $query = "SELECT usuario FROM t_usuarios WHERE usuario = '$usuario'";
            
            $res = mysqli_query($con, $query);

            if(mysqli_num_rows($res) > 0) { echo "Nombre de usuario en uso, escoja otro"; }else{

                $query = "SELECT gmail FROM t_usuarios WHERE gmail = '$gmail'";
            
                $res = mysqli_query($con, $query);

                if(mysqli_num_rows($res) > 0) { echo "El gmail ya está en uso, escoja otro"; }else{

                    if($clave != $rep_clave){ echo "Las contraseñas no coinciden"; }else{

                        // REGISTRAR USUARIO
                        $query = "INSERT INTO t_usuarios(usuario, gmail, fecha_nacimiento, clave, foto_perfil, foto_portada, id_rol, fecha_creacion) VALUES('$usuario', '$gmail','$fecha_nacimiento', '$clave', '$foto_perfil', '$foto_portada', '1', now())";

                        $res = mysqli_query($con, $query);

                        if($res){

                            echo"Felicidades, se registró exitosamente";
                        
                            header("Refresh: 2; url= login.php");

                        }else{

                            echo "Algo salió mal";

                        }

                    }
                    
                }

            }

        }

    ?>

<?php include("includes/footer.html"); ?>