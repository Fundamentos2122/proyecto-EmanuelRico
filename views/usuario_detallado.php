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
    <title>ERSports</title>
</head>
<body class="container">

    <?php include("navbar.php");?>

    <div class="container-fluid container-xl" id="body-content">
        <div class="col-12 my-4 edit-profile-container">
            <h1>Editar perfil</h1>

            <form id="form_put" action="../controllers/editController.php" method="post" autocomplete="off">
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo:</label>
                    <input type="text" name="nombre_completo" class="form-control" id="nombre_completo">
                </div>

                <div class="form-group">
                    <label for="nombre_usuario">Nombre de usuario:</label>
                    <input type="text" name="nombre_usuario" class="form-control" id="nombre_usuario">
                </div>
                
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" class="form-control" id="contrasena">
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento">
                </div>

                <div class="form-group">
                    <label for="tipo_rol">Tipo de rol:</label>
                    <input type="text" name="tipo_rol" class="form-control" id="tipo_rol">
                </div>
                
                <div class="form-group center-text">
                    <input type="submit" value="Actualizar" class="btn success-btn">
                    <a href="index.php" class="btn warning-btn">Cancelar</a>
                </div>
            </form>

            <form id="form_delete" action="../controllers/registerController.php" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" value="Eliminar" class="btn danger-btn">
            </form>
        </div>
    </div>

    <?php include("footer.php");?>

    <script src="https://fundamentos2122.github.io/framework-css-EmanuelRico/js/framework.js"></script>
    <script>
        const formPut = document.getElementById("form_put");
        const formDelete = document.getElementById("form_delete");
        const input_nombreUsuario = document.getElementById("nombre_usuario");
        const input_contrasena = document.getElementById("contrasena");
        const input_nombreCompleto = document.getElementById("nombre_completo");
        const input_fechaNacimiento = document.getElementById("fecha_nacimiento");
        const input_tipoRol = document.getElementById("tipo_rol");

        const id_usuario = "" + <?php echo $_GET["id"] ?> + "";

        getUsuario();

        function getUsuario(){
            var xhttp = new XMLHttpRequest();

            xhttp.open("GET", "../controllers/editController.php?id=" + id_usuario, false);

            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4){
                    var usuario = JSON.parse(xhttp.responseText);

                    formPut.action += "?id=" + usuario.id;
                    //formDelete.action += "?id=" + usuario.id;
                    input_nombreUsuario.value = usuario.nombre_usuario;
                    input_contrasena.value = usuario.contrasena;
                    input_nombreCompleto.value = usuario.nombre_completo;
                    input_fechaNacimiento.value = usuario.fecha_nacimiento;
                    input_tipoRol.value = usuario.tipo_rol;
                    console.log(usuario);
                }
            }

            xhttp.send();
        }
    </script>
</body>
</html>