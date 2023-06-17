<?php

class mainModel
{
    protected function alert($datos)
    {
        if ($datos['Alerta'] == "simple") {
            $alerta = "
                <script>
                    showAlertModal(
                        '" . $datos['Titulo'] . "',
                        '" . $datos['Texto'] . "',
                        '" . $datos['Tipo'] . "',
                        false,
                        1500,
                        null
                    );
                </script>
            ";
        } elseif ($datos['Alerta'] == "limpiar") {
            $alerta = "
                <script>
                    showAlertModal(
                        '" . $datos['Titulo'] . "',
                        '" . $datos['Texto'] . "',
                        '" . $datos['Tipo'] . "',
                        true,
                        function (confirmado) {
                            if (confirmado) {
                                $('.FormularioAjax')[0].reset();
                            }
                        }
                    );
                </script>
            ";
        } elseif ($datos['Alerta'] == "mensaje") {
            $alerta = "
                <script>
                    showAlertModal(
                        '" . $datos['Titulo'] . "',
                        '" . $datos['Texto'] . "',
                        '" . $datos['Tipo'] . "',
                        false
                    );
                </script>
            ";
        }
        return $alerta;
    }

    protected function validarDni($dni)
    {
        // Datos
        $token = 'apis-token-1.aTSI1U7KEuT-6bbbCguH-4Y8TI6KS73N';

        // Iniciar llamada a API
        $curl = curl_init();

        // Buscar dni
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Referer: https://apis.net.pe/consulta-dni-api',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $persona = json_decode($response);

        $dataDNI = json_encode($persona);

        return $dataDNI;
    }

    protected function validarRuc($ruc)
    {
        // Datos
        $token = 'apis-token-4646.9XrYPfbtCttJj2BT-RZTxps2wHXYDofW';

        // Iniciar llamada a API
        $curl = curl_init();

        // Buscar ruc sunat
        curl_setopt_array($curl, array(
            // para usar la versión 2
            CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $ruc,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Referer: http://apis.net.pe/api-ruc',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // Datos de empresas según padron reducido
        $empresa = json_decode($response);

        $dataRUC = json_encode($empresa);

        return $dataRUC;
    }

    protected function generateUserName($nombre, $apellido, $dni){
        $lastname = strpos($apellido, ' ');

        $userName = substr($dni, 0, 4) . substr($nombre, 0, 1) . substr($apellido, 0, $lastname) . substr($dni, 4, 8);

        return $userName;
    }

    protected function encryptePass($password){
        $conexion = Connection::connect();

        $sql = "SELECT EncryptPassword($password) AS passe";
        $result = $conexion->query($sql);

        $resultadoDatos = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($resultadoDatos as $row) {}

        $result = $row['passe'];

        return $result;
    }
}
