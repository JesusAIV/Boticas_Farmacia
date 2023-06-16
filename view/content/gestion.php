<?php

require_once "./controller/gestioncontroller.php";

$gestion = new gestionController();

$datosUser = $gestion->userByIdC($_SESSION['id']);

$pagina = explode("/", $_GET['views']);

if (!empty($_SESSION['idRol']) && $_SESSION['idRol'] == "1") {
    if (empty($pagina[1])) {
        require_once "gestion/inicio.php";
    } else {
        $viewgestion = $pagina[1];
        if ($_SESSION['idRol'] == '1') {
            $ruta = "./view/content/gestion/".$viewgestion.".php";
            if(is_file($ruta)){
                require_once $ruta;
            }else{
                header("Location: ".SERVERURL."gestion");
            }
        }
    }
} else {
    header("Location: ".SERVERURL."inicio");
}