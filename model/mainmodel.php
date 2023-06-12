<?php

class mainModel {
    protected function alert($datos){
        if($datos['Alerta']=="simple"){
            $alerta = "
                <script>
                    showAlertModal(
                        '".$datos['Titulo']."',
                        '".$datos['Texto']."',
                        '".$datos['Tipo']."',
                        false,
                        1500,
                        null
                    );
                </script>
            ";
        }elseif($datos['Alerta']=="limpiar"){
            $alerta = "
                <script>
                    showAlertModal(
                        '".$datos['Titulo']."',
                        '".$datos['Texto']."',
                        '".$datos['Tipo']."',
                        true,
                        function (confirmado) {
                            if (confirmado) {
                                $('.FormularioAjax')[0].reset();
                            }
                        }
                    );
                </script>
            ";
        }elseif($datos['Alerta']=="mensaje"){
            $alerta = "
                <script>
                    showAlertModal(
                        '".$datos['Titulo']."',
                        '".$datos['Texto']."',
                        '".$datos['Tipo']."',
                        false
                    );
                </script>
            ";
        }
        return $alerta;
    }
}