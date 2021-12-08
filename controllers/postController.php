<?php 
    include("../models/DB.php");
    include("../models/Usuario.php");
    include("../models/Post.php");

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

                echo 
                '
                <div class="post">
                    <img src="data:image/jpeg;base64,'. $post->getImagen() . '" class="carrousel-img" alt=""></img>
                    <h1>'. $post->getTitulo() .'</h1>
                    <h2>'. $post->getSubtitulo() .'</h2>
                    
                    <div>
                        <p class="text-post">
                            '. $post->getTexto() .'
                        </p>
                    </div>
                </div>
                ';
            }
            
        }
        else{
            //Traer la información de todos los elementos
            $query = $connection->prepare("SELECT * FROM post");
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

                echo 
                '
                <div class="border primary-border blogs-1">
                    <a href="post.php?id='. $post->getId() .'&usuario_id=' . $post->getUsuarioId() . '">
                        <img src="data:image/jpeg;base64,'. $post->getImagen() . '" class="carrousel-img" alt=""></img>
                        <h1>'. $post->getTitulo() .'</h1>
                        <p>'. $post->getSubtitulo() .'</p>
                    </a>
                </div>
                ';
            }
        }
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["_method"] == "POST"){

            //Guardar
            $titulo = $_POST["titulo"];
            $subtitulo = $_POST["subtitulo"];
            $texto = $_POST["texto"];
            $usuario_id = $_GET["id"];
            $imagen = "";
            $categoria = $_POST["categoria"];

            if(sizeof($_FILES) > 0){
                $tmp_name = $_FILES["imagen"]["tmp_name"];
                $imagen = file_get_contents($tmp_name);
            }

            try{
                $query = $connection->prepare('INSERT INTO post VALUES(NULL, :titulo, :subtitulo, :texto, :usuario_id, :imagen, :categoria)');
                $query->bindParam(":titulo", $titulo, PDO::PARAM_STR);
                $query->bindParam(":subtitulo", $subtitulo, PDO::PARAM_STR);
                $query->bindParam(":texto", $texto, PDO::PARAM_STR);
                $query->bindParam(":usuario_id", $usuario_id, PDO::PARAM_STR);
                $query->bindParam(":categoria", $categoria, PDO::PARAM_STR);
                $query->bindParam(":imagen", $imagen, PDO::PARAM_STR);
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

            $titulo = $_POST["titulo"];
            $subtitulo = $_POST["subtitulo"];
            $texto = $_POST["texto"];
            $categoria = $_POST["categoria"];;
            $imagen = $_POST["imagen"];

            $update_foto = false;

            if(sizeof($_FILES) > 0 && $_FILES["imagen"]["tmp_name"] !== ""){
                $tmp_name = $_FILES["imagen"]["tmp_name"];
                $foto = file_get_contents($tmp_name);
                $update_foto = true;
            }

            try{
                $query_string = 'UPDATE usuarios SET subtitulo = :subtitulo, texto = :texto, titulo = :titulo';
                
                if($update_foto === true){
                    $query_string = $query_string . ', imagen = :imagen';
                }

                $query = $connection->prepare($query_string . ' WHERE id = :id');
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->bindParam(":subtitulo", $subtitulo, PDO::PARAM_STR);
                $query->bindParam(":texto", $texto, PDO::PARAM_STR);
                $query->bindParam(":titulo", $titulo, PDO::PARAM_STR);
                $query->bindParam(":imagen", $imagen, PDO::PARAM_STR);
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
                exit();
            }
        }
        else{
            //Error
            echo "No se detectó ningún método";
        }
    }
    
?>