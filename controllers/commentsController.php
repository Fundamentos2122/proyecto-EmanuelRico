<?php 
    include("../models/Comentario.php");

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        //Leer
        if(array_key_exists("id", $_GET) && array_key_exists("usuario_id", $_GET)){

            try{
                $connection = DBConnection::getConnection();
            }
            catch(PDOException $e){
                error_log("Error de conexión - " . $e, 0);

                header("Location: http://localhost/ermsports/views/error.php?error=ERROR DE CONEXIÓN A LA BASE DE DATOS");
                
                exit();
            }
            //Traer la información de un elemento
                $post_id = $_GET["id"];
                $usuario_id = $_GET["usuario_id"];

                $query = $connection->prepare("SELECT * FROM comentarios WHERE usuario_id = :usuario_id AND post_id = :post_id");
                $query->bindValue(":usuario_id", $usuario_id, PDO::PARAM_INT);
                $query->bindValue(":post_id", $post_id, PDO::PARAM_INT);
                $query->execute();

                while($row = $query->fetch(PDO::FETCH_ASSOC)){
                    $comentario = new Comentario(
                        $row["texto"], 
                        $row["usuario_id"], 
                        $row["post_id"], 
                    );

                    echo 
                    '
                    <div class="border secondary-border comment">
                        <a href="#" class="nav-link btn light-btn user">'. $comentario->getUsuarioId() .'</a>
                        <div class="comment-text">
                            <p>
                                ' . $comentario->getTexto() . '
                            </p>
                        </div>
                    </div>
                    ';
                }


        }
        else{
            //Traer la información de todos los elementos
            try{
                
            }
            catch(PDOException $e){
                error_log("Error en query - " . $e, 0);
                exit();
            }
        }
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        include("../models/DB.php");

        try{
            $connection = DBConnection::getConnection();
        }
        catch(PDOException $e){
            error_log("Error de conexión - " . $e, 0);
            exit();
        }

        if($_POST["_method"] == "POST"){
            //Guardar
            $texto = $_POST["comentario"];
            $post_id = $_GET["id"];
            $usuario_id = $_GET["usuario_id"];

            var_dump($usuario_id);

            try{
                $query = $connection->prepare('INSERT INTO comentarios VALUES(:texto, :usuario_id, :post_id)');
                $query->bindParam(":texto", $texto, PDO::PARAM_STR);
                $query->bindParam(":usuario_id", $usuario_id, PDO::PARAM_STR);
                $query->bindParam(":post_id", $post_id, PDO::PARAM_STR);

                $query->execute();

                if($query->rowCount() == 0){
                    //Error
                    exit();
                }

                header("Location: http://localhost/ermsports/views/post.php?id=" . $post_id . "&usuario_id=" . $usuario_id);
            }
            catch(PDOException $e){
                error_log("Error en query - " . $e, 0);
                exit();
            }
        }
        else if($_POST["_method"] == "PUT"){
            //Actualizar
            
        }
        else if($_POST["_method"] == "DELETE"){
            //Eliminar
            
        }
        else{
            //Error
            echo "No se detectó ningún método";
        }
    }
    
?>