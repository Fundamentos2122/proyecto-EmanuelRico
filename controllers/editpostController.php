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
        
        else{
            //No jaló
            var_dump("error");
        }
    }
?>