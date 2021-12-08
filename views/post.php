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
        <div class="row">
            <?php include("sidebar.php");?>
            
            <div class="col principal-content">

                <?php include("../controllers/postController.php")?>

                <form id="form_post" action="../controllers/commentsController.php" method="post" autocomplete="off">
                <input type="hidden" name="_method" value="POST">
                <div class="border primary-border comments-section">
                    <?php include("../controllers/commentsController.php");?>
                </div>
                <div class="border secondary-border comment">
                    <textarea class="textarea-comment" style="width: 96.5%" name="comentario" id="comentario" ></textarea>
                    <?php if(array_key_exists("nombre_usuario", $_SESSION)){
                        echo '<button class="btn primary-btn" style="margin: 0.01em 1em;" type="submit">Comentar</button>';
                    }?>
                </div>
                </form>

            </div>
            <div class="col-3 col-md-2">
                <img src="../imagenes/pub1.gif" class="publicity" alt="">
            </div>
        </div>
    </div>

    <?php include("footer.php");?>

    <script src="https://fundamentos2122.github.io/framework-css-EmanuelRico/js/framework.js"></script>
    <script>
        const formPost = document.getElementById("form_post");

        const id_post = "" + <?php echo $_GET["id"] ?> + "";
        const id_usuario = "" + <?php echo $_GET["usuario_id"] ?> + "";

        getUsuario();

        function getUsuario(){
            var xhttp = new XMLHttpRequest();

            xhttp.open("GET", "../controllers/commentsController.php?id=" + id_post + "&usuario_id=" + id_usuario, false);

            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4){
                    formPost.action += "?id=" + id_post + "&usuario_id=" + id_usuario;

                }
            }

            xhttp.send();
        }
    </script>
</body>
</html>