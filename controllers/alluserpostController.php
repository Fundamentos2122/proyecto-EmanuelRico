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
            
        }
        else{
            //Traer la información de todos los elementos
            $usuario_id = $_GET["usuario_id"];

            $query = $connection->prepare("SELECT * FROM post WHERE usuario_id = :usuario_id");
            $query->bindValue(":usuario_id", $usuario_id, PDO::PARAM_INT);
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
                    <a href="edit_post_seleccionado.php?id='. $post->getId() .'">
                        <img src="data:image/jpeg;base64,'. $post->getImagen() . '" class="carrousel-img" alt=""></img>
                        <h1>'. $post->getTitulo() .'</h1>
                        <p>'. $post->getSubtitulo() .'</p>
                    </a>
                </div>
                ';
            }
        }

    }
    
?>