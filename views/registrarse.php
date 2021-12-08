<?php 
    //Verificar que el usuario esté loggeado
    session_start();

    if(array_key_exists("nombre_usuario", $_SESSION)){
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
    <title>ERSports</title>
</head>
<body class="container">

    <?php include("modal_inicio_sesion.php");?>
    <?php include("navbar.php");?>

    <div class="container-fluid container-xl" id="body-content">
        <div class="col-12 my-4 edit-profile-container">
            <h1>Registrarse</h1>

            <form action="../controllers/registerController.php" method="post" autocomplete="off">
                <input type="hidden" name="_method" value="POST">
                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo:</label>
                    <input type="text" name="nombre_completo" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nombre_usuario">Nombre de usuario:</label>
                    <input type="text" name="nombre_usuario" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" required>
                </div>
                
                <div class="form-group center-text">
                    <input type="submit" value="Registrarse" class="btn success-btn">
                    <a href="index.php" class="btn danger-btn">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <?php include("footer.php");?>

    <script src="https://fundamentos2122.github.io/framework-css-EmanuelRico/js/framework.js"></script>
</body>
</html>