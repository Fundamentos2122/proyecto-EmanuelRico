<?php
    session_start();

    if(!array_key_exists("nombre_usuario", $_SESSION)){
        header("Location: http://localhost/ermsports/views/");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fundamentos2122.github.io/framework-css-EmanuelRico/css/framework.css">
    <link rel="stylesheet" href="css/index_styles.css">
    <title>Lista de usuarios</title>
</head>
<body class="container">
    <?php include("navbar.php");?>

    <div class="container-fluid container-xl" id="body-content">
        <div class="col-12 my-4 edit-profile-container">
            <h1>Lista de usuarios</h1>
                
            <?php include("../controllers/registerController.php")?>

        </div>
    </div>

    <?php include("footer.php");?>
    
    <script src="https://fundamentos2122.github.io/framework-css-EmanuelRico/js/framework.js"></script>
</body>
</html>