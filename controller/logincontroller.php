<?php
if ($ajax) {
    require_once "../model/loginmodel.php";
} else {
    require_once "./model/loginmodel.php";
}

class loginController extends LoginModel{
    public function iniciarSesionC(){
        $user = $_POST['user'];
        $password = $_POST['password'];

        $datosLogin = [
            "user"=>$user,
            "password"=>$password
        ];

        $datosSesion = LoginModel::iniciarSesion($datosLogin);

        $numquery = $datosSesion->num_rows;

        $respuesta = "";

        if ($numquery == 1) {
            session_destroy();
            session_start();

            $listResultado = $datosSesion->fetch_assoc();

            if ($listResultado['@result'] == 1) {
                $userData = json_decode($listResultado['@datos'], true);

                $_SESSION['id'] = $userData['id'];
                $_SESSION['idRol'] = $userData['idRol'];
                $_SESSION['name'] = $userData['name'];
                $_SESSION['lastName'] = $userData['lastName'];
                $_SESSION['email'] = $userData['email'];
                $_SESSION['userName'] = $userData['userName'];

                $urlRedireccion = "";

                if ($userData['idRol'] == 1) {
                    $urlRedireccion = SERVERURL."gestion/inicio";
                } elseif ($userData['idRol'] == 2) {
                    $urlRedireccion = SERVERURL;
                } else {
                    $urlRedireccion = SERVERURL;
                }

                $respuesta = '<script>window.location="'.$urlRedireccion.'"</script>';
            } else {
                $respuesta = 'Datos incorrectos';
            }

        } else {
            $respuesta = "Error en servidor";
        }

        return $respuesta;
    }
}