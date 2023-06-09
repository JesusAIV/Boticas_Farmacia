<?php
    class viewModel{
        protected function obtenervistamodelo($views){

            if(is_file("./view/content/".$views.".php")){
                $contenido = "./view/content/".$views.".php";
            }else{
                $contenido = "inicio";
            }
            return $contenido;
        }
    }