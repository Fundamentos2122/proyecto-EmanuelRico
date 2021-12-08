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

    <?php include("modal_inicio_sesion.php"); session_start();?>
    <?php include("navbar.php");?>

    <div class="container-fluid container-xl" id="body-content">
        <div class="col-12 border primary-border edit-post-container">
            <h1>Editar post</h1>

            <form id="form_put" action="../controllers/pruebaController.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="titulo">Título del post</label>
                    <input type="text" name="titulo" class="form-control edit-post" id="titulo">
                </div>

                <div class="form-group">
                    <label for="subtitulo">Subtítulo del post</label>
                    <input type="text" name="subtitulo" class="form-control edit-post" id="subtitulo">
                </div>
                
                <div class="form-group">
                    <label for="texto">Descripción del post</label>
                    <textarea name="texto" class="form-control edit-post" id="descripcion"></textarea>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría del post(Futbol, Basquetbol, Beisbol, FA, F1)</label>
                    <input type="text" name="categoria" class="form-control edit-post" id="categoria">
                </div>

                <div class="form-group">
                    <label for="imagen">Selecciona la imágen del post:</label>
                    <input type="file" name="imagen" class="form-control edit-post">
                </div>
                
                <input class="btn primary-btn" type="submit" value="Editar">
                <a href="index.php" class="btn warning-btn">Cancelar</a>
            </form>

            <form id="form_delete" action="../controllers/pruebaController.php" method="POST">
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
        const input_titulo = document.getElementById("titulo");
        const input_subtitulo = document.getElementById("subtitulo");
        const input_descripcion = document.getElementById("descripcion");
        const input_categoria = document.getElementById("categoria");

        const id_post = "" + <?php echo $_GET["id"] ?> + "";

        getPost();

        function getPost(){
            var xhttp = new XMLHttpRequest();

            xhttp.open("GET", "../controllers/pruebaController.php?id=" + id_post, false);

            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4){
                    var post = JSON.parse(xhttp.responseText);

                    formPut.action += "?id=" + post.id;
                    formDelete.action += "?id=" + post.id;
                    input_titulo.value = post.titulo;
                    input_subtitulo.value = post.subtitulo;
                    input_descripcion.value = post.texto;
                    input_categoria.value = post.categoria;
                }
            }

            xhttp.send();
        }
    </script>
</body>
</html>