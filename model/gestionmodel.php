<?php

if ($ajax) {
    require_once "../../model/mainmodel.php";
    require_once "../../config/constantes.php";
    require_once "../../config/conexion.php";
} else {
    require_once "./model/mainmodel.php";
    require_once "./config/constantes.php";
    require_once "./config/conexion.php";
}

/**
 * Clase Model para la gestion del sistema
 */
class gestionModel extends mainModel
{

    /**
     * Funcion que devuelve todos los datos de un usuario buscado por su id
     *
     * @param int $idUser
     * @return mixed retorna el query con los datos del usuario
     */
    protected function userByIdM($idUser)
    {
        $conexion = Connection::connect();

        $sql = "CALL UserById($idUser)";
        $result = $conexion->query($sql);
        return $result;
    }

    /**
     * Funcion que devuelve registros según paginación
     *
     * @param int $idUser
     * @param int $inicio
     * @param int $cantidad
     * @return array Registros obtenidos
     */
    protected function obtenerUsuariosM($idUser, $inicio, $cantidad) {

        $conexion = Connection::connect();

        $sql = "CALL ListUsersGestion($idUser, $inicio, $cantidad)";
        $result = $conexion->query($sql);

        $registros = [];
        while ($row = $result->fetch_assoc()) {
            $registros[] = $row;
        }

        return $registros;
    }

    /**
     * Función que cuenta el total de cantidad de registros de la tabla usuario
     *
     * @param int $idUser
     * @return int Total de usuarios
     */
    protected function contarUsuariosM($idUser) {

        $conexion = Connection::connect();

        $sql = "CALL CountUsers($idUser)";
        $result = $conexion->query($sql);
        $row = $result->fetch_assoc();

        return $row['totalUsers'];
    }
}
