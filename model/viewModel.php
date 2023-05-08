<?php
    class viewModel{
        protected function obtenervistamodelo($views){
            $lista = ["inicio", "almacen", "compras", "ventas"];

            if(in_array($views,$lista)){
                if(is_file("./view/content/".$views.".php")){
                    $contenido = "./view/content/".$views.".php";
                }else{
                    $contenido = "inicio";
                }
            }else{
                $contenido = "inicio";
            }
            return $contenido;
        }
    }