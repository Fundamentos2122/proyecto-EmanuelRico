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
        <div class="col-12 border primary-border edit-post-container">
            <h1>Crear post</h1>

            <form id="form_post" action="../controllers/postController.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="POST">

                <div class="form-group">
                    <label for="titulo">Título del post</label>
                    <input type="text" name="titulo" class="form-control edit-post" required>
                </div>

                <div class="form-group">
                    <label for="subtitulo">Subtítulo del post</label>
                    <input type="text" name="subtitulo" class="form-control edit-post" required>
                </div>
                
                <div class="form-group">
                    <label for="texto">Descripción del post</label>
                    <textarea name="texto" class="form-control edit-post" required></textarea>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría del post(Futbol, Basquetbol, Beisbol, FA, F1)</label>
                    <input type="text" name="categoria" class="form-control edit-post" required>
                </div>

                <div class="form-group">
                    <label for="imagen">Selecciona la imágen del post:</label>
                    <input type="file" name="imagen" class="form-control edit-post" required>
                </div>
                
                <input class="btn primary-btn" type="submit" value="Crear">
                <a href="index.php" class="btn danger-btn">Cancelar</a>
            </form>
        </div>
    </div>

    <?php include("footer.php");?>

    <script src="https://fundamentos2122.github.io/framework-css-EmanuelRico/js/framework.js"></script>
    <script>
        const formPost = document.getElementById("form_post");

        const id_usuario = "" + <?php echo $_GET["id"] ?> + "";
        

        getUsuario();

        function getUsuario(){
            var xhttp = new XMLHttpRequest();

            xhttp.open("GET", "../controllers/postController.php?id=" + id_usuario, false);

            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4){

                    formPost.action += "?id=" + id_usuario;
                }
            }

            xhttp.send();
        }
    </script>
</body>
</html>