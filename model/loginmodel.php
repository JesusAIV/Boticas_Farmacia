<?php

if ($ajax){
    require_once "../config/conexion.php";
} else {
    require_once "./config/conexion.php";
}

class LoginModel{
    /**
     * Función para validar el inicio de sesion con la base de datos
     *
     * @param array $datos
     * @return mixed
     */
    protected function iniciarSesion($datos){
        $conexion = Connection::connect();

        // Datos
        $user = $datos['user'];
        $password = $datos['password'];

        $sql = "CALL LoginUser('$user', '$password', @result, @datos)";
        $sql = $conexion->query($sql);

        $result = "SELECT @result, @datos";
        $result = $conexion->query($result);

        return $result;
    }
}