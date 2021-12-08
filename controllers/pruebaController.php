<?php
    include("../models/DB.php");
    include("../models/Post.php");
    include("../models/Usuario.php");

    try{
        $connection = DBConnection::getConnection();
    }
    catch(PDOException $e){
        error_log("Error de conexión - " . $e, 0);

        header("Location: http://localhost/ermsports/views/error.php?error=ERROR DE CONEXIÓN A LA BASE DE DATOS");

        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        //Leer
        if(array_key_exists("id", $_GET)){
            //Traer la información de un elemento

            $id = $_GET["id"];

            try{
                $query = $connection->prepare("SELECT * FROM post WHERE id = :id");
                $query->bindValue(":id", $id, PDO::PARAM_INT);
                $query->execute();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $post = new Post(
                        $row["id"],
                        $row["titulo"], 
                        $row["subtitulo"], 
                        $row["texto"], 
                        $row["usuario_id"], 
                        $row["imagen"],
                        $row["categoria"],
                    );

                    $post->returnJSON();
                }
            }
            catch(PDOException $e){
                error_log("Error en query - " . $e, 0);

                header("Location: http://localhost/ermsports/views/error.php?error=ERROR DE CONEXIÓN A LA BASE DE DATOS");
                
                exit();
            }
        }
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if($_POST["_method"] == "PUT"){
            //Actualizar
            $id = $_GET["id"];

            $titulo = $_POST["titulo"];
            $subtitulo = $_POST["subtitulo"];
            $texto = $_POST["texto"];
            $categoria = $_POST["categoria"];;
            $imagen = "";

            $update_foto = false;

            if(sizeof($_FILES) > 0 && $_FILES["imagen"]["tmp_name"] !== ""){
                $tmp_name = $_FILES["imagen"]["tmp_name"];
                $imagen = file_get_contents($tmp_name);
                $update_foto = true;
            }

            try{
                $query_string = 'UPDATE post SET titulo = :titulo, subtitulo = :subtitulo, texto = :texto, categoria = :categoria';
                    
                if($update_foto === true){
                    $query_string = $query_string . ', imagen = :imagen';
                }

                $query = $connection->prepare($query_string . ' WHERE id = :id');
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->bindParam(":subtitulo", $subtitulo, PDO::PARAM_STR);
                $query->bindParam(":texto", $texto, PDO::PARAM_STR);
                $query->bindParam(":titulo", $titulo, PDO::PARAM_STR);
                $query->bindParam(":categoria", $categoria, PDO::PARAM_STR);
                if($update_foto === true){
                    $query->bindParam(":imagen", $imagen, PDO::PARAM_STR);
                }
                $query->execute();

                if($query->rowCount() == 0){
                    //Error
                    exit();
                }

                header("Location: http://localhost/ermsports/views/");
            }
            catch(PDOException $e){
                error_log("Error en query - " . $e, 0);

                header("Location: http://localhost/ermsports/views/error.php?error=ERROR DE CONEXIÓN A LA BASE DE DATOS");

                exit();
            }
        }
        else if($_POST["_method"] == "DELETE"){
            //Eliminar
            $id = $_GET["id"];

            try{
                $query = $connection->prepare('DELETE FROM post WHERE id = :id');
                $query->bindParam(':id', $id, PDO::PARAM_INT);

                $query->execute();

                if($query->rowCount() == 0){
                    //Error
                    exit();
                }

                header("Location: http://localhost/ermsports/views/");
            }
            catch(PDOException $e){
                error_log("Error en query - " . $e, 0);

                header("Location: http://localhost/ermsports/views/error.php?error=ERROR DE CONEXIÓN A LA BASE DE DATOS");

                exit();
            }
        }
        else{
            //Error
            header("Location: http://localhost/ermsports/views/error.php?error=ERROR DE CONEXIÓN A LA BASE DE DATOS");
        }
    }
?>