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
            
            <div class="col-9 col-lg-8 principal-content">
                <?php include("../controllers/beisbolpostController.php")?>
            </div>

            <div class="col-3 col-md-2">
                <img src="../imagenes/pub2.gif" class="publicity" alt="">
                <img src="../imagenes/pub1.gif" class="publicity" alt="">
                <img src="../imagenes/pub3.gif" class="publicity" alt="">
            </div>
        </div>
    </div>

    <?php include("footer.php");?>

    <script src="https://fundamentos2122.github.io/framework-css-EmanuelRico/js/framework.js"></script>
</body>
</html>