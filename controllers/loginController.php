<?php 

    include("../models/DB.php");
    include("../models/Usuario.php");

    try{
        $connection = DBConnection::getConnection();
    }
    catch(PDOException $e){
        error_log("Error de conexión - " . $e, 0);
        //header("Location: http://localhost/practicaphp-EmanuelRico/views/error.php?error=ERROR DE CONEXIÓN A LA BASE DE DATOS");
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["_method"] == "POST"){
            //Login
            
            $nombre_usuario = $_POST["nombre_usuario"];
            $contrasena = $_POST["contrasena"];

            try{
                $query = $connection->prepare('SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario AND contrasena = :contrasena');
                $query->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
                $query->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
                $query->execute();

                if($query->rowCount() == 0){
                    //No se encontró al usuario
                    header("Location: http://localhost/ermsports/views/index.php?error=Usuario y/o contraseña invalida");
                    exit();
                }

                $usuario;

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $usuario = new Usuario($row["id"], $row["nombre_usuario"], $row["contrasena"], $row["tipo_rol"], $row["nombre_completo"], $row["fecha_nacimiento"]);
                }

                session_start();
                $_SESSION["id"] = $usuario->getId();
                $_SESSION["nombre_usuario"] = $usuario->getNombre_usuario();
                $_SESSION["tipo_rol"] = $usuario->getTipoRol();

                header("Location: http://localhost/ermsports/views/");
            }
            catch(PDOException $e){
                error_log("Error en query - " . $e, 0);
                //header("Location: http://localhost/practicaphp-EmanuelRico/views/error.php?error=ERROR DE INICIO DE SESIÓN");
                exit();
            }
        }
        else if($_POST["_method"] == "DELETE"){
            //Logout
            session_start();

            session_destroy();
            header("Location: http://localhost/ermsports/views/");
        }
    }
?>