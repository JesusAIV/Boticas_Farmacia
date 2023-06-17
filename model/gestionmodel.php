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
    protected function obtenerUsuariosM($idUser, $inicio, $cantidad)
    {

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
    protected function contarUsuariosM($idUser)
    {

        $conexion = Connection::connect();

        $sql = "CALL CountUsers($idUser)";
        $result = $conexion->query($sql);
        $row = $result->fetch_assoc();

        return $row['totalUsers'];
    }

    /**
     * Funcion para listar los roles de los usuarios
     */
    protected function ListRolM()
    {
        $conexion = Connection::connect();

        $sql = "CALL SelectRolGestion()";
        $result = $conexion->query($sql);

        return $result;
    }

    /**
     *
     */
    protected function ListTypeDocM(){
        $conexion = Connection::connect();

        $sql = "CALL SelectTypeDoc()";
        $result = $conexion->query($sql);

        return $result;
    }

    /**
     *
     */
    public function rolByIdM($idRol)
    {
        $conexion = Connection::connect();

        $sql = "CALL RolById($idRol)";
        $result = $conexion->query($sql);

        return $result;
    }

    /**
     *
     */
    public function typeDocByIdM($idTypeDoc)
    {
        $conexion = Connection::connect();

        $sql = "CALL TypeDocById($idTypeDoc)";
        $result = $conexion->query($sql);

        return $result;
    }

    /**
     *
     */
    protected function updateUserM($datosU){
        $conexion = Connection::connect();

        $p_id = $datosU['id'];
        $p_idRol = $datosU['idRol'];
        $p_userName = $datosU['userName'];
        $p_idTypeDoc = $datosU['idTypeDoc'];
        $p_numDoc = $datosU['numDoc'];
        $p_name = $datosU['name'];
        $p_lastName = $datosU['lastName'];
        $p_email = $datosU['email'];
        $p_telephone = $datosU['telephone'];
        $p_image = $datosU['image'];

        $sql = "CALL UpdateUser($p_id, $p_idRol, '$p_userName', $p_idTypeDoc, '$p_numDoc', '$p_name', '$p_lastName', '$p_email', '$p_telephone', '$p_image')";

        $result = $conexion->query($sql);

        return $result;
    }

    protected function deleteUserByIdM($idUser){
        $conexion = Connection::connect();


        $sql = "CALL DeleteUserById($idUser)";

        $result = $conexion->query($sql);

        return $result;
    }

    protected function createUserM($datosU){
        $conexion = Connection::connect();

        $p_idRol = $datosU['idRol'];
        $p_idTypeDoc = $datosU['idTypeDoc'];
        $p_numDoc = $datosU['numDoc'];
        $p_name = $datosU['name'];
        $p_lastName = $datosU['lastName'];
        $p_email = $datosU['email'];
        $p_userName = $datosU['userName'];
        $p_password = $datosU['password'];
        $p_image = $datosU['image'];
        $p_telephone = $datosU['telephone'];

        $sql = "CALL CreateUserGestion($p_idRol, $p_idTypeDoc, $p_numDoc, '$p_name', '$p_lastName', '$p_email', '$p_userName', '$p_password', '$p_image', '$p_telephone')";

        $result = $conexion->query($sql);

        return $result;
    }

}
