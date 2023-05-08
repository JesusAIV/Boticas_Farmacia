<?php
    require_once  "./models/viewModel.php";

    class viewController extends viewModel
    {
        public function obtenersistema()
        {
            return require_once "./view/inicio.php";
        }
        public function obtenervistacontrolador()
        {
            if (isset($_GET['views'])) {
                $ruta = explode("/", $_GET['views']);
                $respuesta = viewmodel::obtenervistamodelo($ruta[0]);
            } else {
                $respuesta = "inicio";
            }
            return $respuesta;
        }
    }