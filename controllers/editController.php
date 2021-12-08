<?php 
    include("../models/DB.php");
    include("../models/Usuario.php");

    try{
        $connection = DBConnection::getConnection();
    }
    catch(PDOException $e){
        error_log("Error de conexión - " . $e, 0);
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        //Leer
        if(array_key_exists("id", $_GET)){
            //Traer la información de un elemento

            $id = $_GET["id"];

            try{
                $query = $connection->prepare("SELECT * FROM usuarios WHERE id = :id");
                $query->bindValue(":id", $id, PDO::PARAM_INT);
                $query->execute();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $usuario = new Usuario(
                        $row["id"], 
                        $row["nombre_usuario"], 
                        $row["contrasena"], 
                        $row["tipo_rol"], 
                        $row["nombre_completo"],
                        $row["fecha_nacimiento"],
                    );

                    $usuario->returnJSON();
                }
            }
            catch(PDOException $e){
                error_log("Error en query - " . $e, 0);
                exit();
            }
        }
        else{
            //Traer la información de todos los elementos
            try{
                $query = $connection->prepare("SELECT * FROM usuarios");
                $query->execute();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $usuario = new Usuario(
                        $row["id"], 
                        $row["nombre_usuario"], 
                        $row["contrasena"], 
                        $row["tipo_rol"], 
                        $row["nombre_completo"],
                        $row["fecha_nacimiento"],
                    );

                    echo 
                    '<a href="usuario_detallado.php?id=' . $usuario->getId() . '" class="btn primary-btn" style="margin-top: 1em;">' . ucfirst($usuario->getNombre_usuario()) . '</a>';
                }
            }
            catch(PDOException $e){
                error_log("Error en query -" . $e, 0);
                exit();
            }

        }
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["_method"] == "POST"){
            //Guardar
            $nombre_completo = $_POST["nombre_completo"];
            $nombre_usuario = $_POST["nombre_usuario"];
            $contrasena = $_POST["contrasena"];
            $tipo_rol = $_POST["tipo_rol"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];

            try{
                $query = $connection->prepare('INSERT INTO usuarios VALUES(NULL, :nombre_usuario, :contrasena, :tipo_rol, :nombre_completo, :fecha_nacimiento)');
                $query->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
                $query->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
                $query->bindParam(":tipo_rol", $tipo_rol, PDO::PARAM_STR);
                $query->bindParam(":nombre_completo", $nombre_completo, PDO::PARAM_STR);
                $query->bindParam(":fecha_nacimiento", $fecha_nacimiento, PDO::PARAM_STR);
                $query->execute();

                if($query->rowCount() == 0){
                    //Error
                    exit();
                }

                header("Location: http://localhost/ermsports/views/");
            }
            catch(PDOException $e){
                error_log("Error en query - " . $e, 0);
                exit();
            }
        }
        else if($_POST["_method"] == "PUT"){
            //Actualizar
            $id = $_GET["id"];

            $nombre_completo = $_POST["nombre_completo"];
            $nombre_usuario = $_POST["nombre_usuario"];
            $contrasena = $_POST["contrasena"];
            $tipo_rol = $_POST["tipo_rol"];
            $fecha_nacimiento = $_POST["fecha_nacimiento"];

            try{

                $query = $connection->prepare('UPDATE usuarios SET nombre_usuario = :nombre_usuario, contrasena = :contrasena, tipo_rol = :tipo_rol, nombre_completo = :nombre_completo, fecha_nacimiento = :fecha_nacimiento WHERE id = :id');
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->bindParam(":nombre_usuario", $nombre_usuario, PDO::PARAM_STR);
                $query->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
                $query->bindParam(":tipo_rol", $tipo_rol, PDO::PARAM_STR);
                $query->bindParam(":nombre_completo", $nombre_completo, PDO::PARAM_STR);
                $query->bindParam(":fecha_nacimiento", $fecha_nacimiento, PDO::PARAM_STR);

                $query->execute();

                if($query->rowCount() == 0){
                    //Error
                    exit();
                }

                header("Location: http://localhost/ermsports/views/");
            }
            catch(PDOException $e){
                error_log("Error en query - " . $e, 0);
                exit();
            }
        }
        else{
            //Error
            echo "No se detectó ningún método";
        }
    }
    
?>