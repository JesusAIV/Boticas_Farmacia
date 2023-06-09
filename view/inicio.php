<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once "./config/constantes.php";

    $viewurl = "";

    if(empty($_GET['views'])){
        $viewurl = "inicio";
    } else {
        // Separa el "/" de la url y obtiene la vista ingresada en la url
        $pagina = explode("/", $_GET['views']);
        // Obtiene la posicion "0"
        $viewurl = $pagina[0];
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo NAME ?></title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <?php
        if (!empty($_SESSION['id']) && $viewurl == 'gestion') {
            echo '<link rel="stylesheet" type="text/css" href="'.SERVERURL.'view/assets/css/stylead.css">';
        } elseif ($viewurl == 'login') {
            echo '<link rel="stylesheet" type="text/css" href="'.SERVERURL.'view/assets/css/stylelogin.css">';
        }
    ?>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <script src="sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="graficos.js"></script>
</head>

<body>
    <?php
        $ajax = false;
        require_once "./controller/viewController.php";
        $view = new viewController();
        $vistas = $view->obtenervistacontrolador();

        if ($vistas == "inicio") {
            $vistas = "./view/content/inicio.php";
        }
    ?>

    <?php
    $classMain = "";
    if ($viewurl === 'gestion'){
        include "layout/contentad.php";
        $classMain = "container-main";
    } else {
        include "layout/header.php";
        $classMain = "container-web";
    }
    ?>

    <div class="<?php echo $classMain ?>">
        <?php require_once $vistas; ?>
    </div>

</body>
</html>