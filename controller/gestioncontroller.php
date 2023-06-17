<?php

if ($ajax) {
    require_once "../../model/gestionmodel.php";
    require_once "../../config/constantes.php";
} else {
    require_once "./model/gestionmodel.php";
    require_once "./config/constantes.php";
}

/**
 * Clase Controller para la gestion del sistema
 */
class gestionController extends gestionModel
{
    /**
     * Funcion recibe el query de la funcion userByIdM
     *
     * @param int $idUser
     * @return array Datos del usuario
     */
    public function userByIdC($idUser)
    {
        $datosUser = gestionModel::userByIdM($idUser);

        $numquery = $datosUser->num_rows;

        $resultadoDatos = "";

        if ($numquery == 1) {
            $resultadoDatos = $datosUser->fetch_all(MYSQLI_ASSOC);
        } else {
            $resultadoDatos = "Error en servidor";
        }

        return $resultadoDatos;
    }

    /**
     * Funcion para paginar la tabla de usuarios
     *
     * @param int $idUser
     * @return mixed Retorna tabla en contenido HTML
     */
    public function paginationUsers($idUser)
    {
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $cantidad = 8;

        $totalRegistros = gestionModel::contarUsuariosM($idUser);
        $totalPaginas = ceil($totalRegistros / $cantidad);

        if ($pagina < 1) {
            $pagina = 1;
        }

        $inicio = ($pagina - 1) * $cantidad;

        $registros =  gestionModel::obtenerUsuariosM($idUser, $inicio, $cantidad);

        $tabla = '';

        $tabla .= '
            <div class="table">
                <table class="table_usuarios" id="table_usuarios">
                    <thead class="thead_usuarios">
                        <tr class="tr-thead_usuarios">
                            <th class="th_usuarios">ID</th>
                            <th class="th_usuarios">Rol</th>
                            <th class="th_usuarios">Numero de documento</th>
                            <th class="th_usuarios">Nombres y apellidos</th>
                            <th class="th_usuarios">Nombre de usuario</th>
                            <th class="th_usuarios">Correo</th>
                            <th class="th_usuarios">Telefono</th>
                            <th class="th_usuarios">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="tbody_usuarios">
        ';

        if (!empty($registros)) {
            foreach ($registros as $registro) {
                $tabla .= '
                    <tr class="tr-tbody_usuarios" data-id="' . $registro['id'] . '">
                        <td class="td_usuarios">' . $registro['id'] . '</td>
                        <td class="td_usuarios">' . $registro['rol'] . '</td>
                        <td class="td_usuarios">' . $registro['numDoc'] . '</td>
                        <td class="td_usuarios">' . $registro['name'] . ' ' . $registro['lastName'] . '</td>
                        <td class="td_usuarios">' . $registro['userName'] . '</td>
                        <td class="td_usuarios">' . $registro['email'] . '</td>
                        <td class="td_usuarios">' . $registro['telephone'] . '</td>
                        <td class="td_usuarios td-acciones_usuarios">
                            <button class="accion accion-ver_usuarios">Ver</button>
                            <button class="accion accion-editar_usuarios">Editar</button>
                            <button class="accion accion-eliminar_usuarios">Eliminar</button>
                        </td>
                    </tr>
                ';
            }
            $tabla .= '
                </tbody>
            </table>
            <div class="respuestaDelete"></div>
        </div>
        <div class="container_pagination">
            <div class="pagination">
        ';

            if ($pagina > 1) {
                $tabla .= '
                <div class="pagination_control pagination_previous">
                    <a href="' . SERVERURL . 'gestion/usuarios?pagina=' . ($pagina - 1) . '" class="previous">Anterior</a>
                </div>
            ';
            }

            $tabla .= '<div class="pagination_numbers">';

            for ($i = 1; $i <= $totalPaginas; $i++) {
                if ($i == $pagina) {
                    $tabla .= '<a href="' . SERVERURL . 'gestion/usuarios?pagina=' . $i . '" class="number number_active">' . $i . '</a>';
                } else {
                    $tabla .= '<a href="' . SERVERURL . 'gestion/usuarios?pagina=' . $i . '" class="number">' . $i . '</a>';
                }
            }

            $tabla .= '</div>';

            if ($pagina < $totalPaginas) {
                $tabla .= '
                <div class="pagination_control pagination_next">
                    <a href="' . SERVERURL . 'gestion/usuarios?pagina=' . ($pagina + 1) . '" class="next">Siguiente</a>
                </div>
            ';
            }

            $tabla .= '
            </div>
        </div>
            ';
        } else {
            $tabla .= '
                <tr class="tr-tbody_usuarios">
                    <td class="td_usuarios" colspan="8">
                    No hay registros
                    <a href="' . SERVERURL . 'gestion/usuarios?pagina=' . (1) . '" class="error_registro">Ir a pagina 1</a>
                    </td>
                </tr>
            ';
        }

        return $tabla;
    }

    /**
     *
     */
    public function ListRolC()
    {
        $datos = gestionModel::ListRolM();

        $mData = array();

        foreach ($datos as $row) {
            $data = [
                "id" => $row['id'],
                "rol" => $row['rol']
            ];
            $mData[] = $data;
        }

        $data = json_encode($mData, JSON_UNESCAPED_UNICODE);

        return $data;
    }

    /**
     *
     */
    public function ListTypeDocC()
    {
        $datos = gestionModel::ListTypeDocM();

        $mData = array();

        foreach ($datos as $row) {
            $data = [
                "id" => $row['id'],
                "typeDoc" => $row['typeDoc']
            ];
            $mData[] = $data;
        }

        $data = json_encode($mData, JSON_UNESCAPED_UNICODE);

        return $data;
    }

    /**
     *
     */
    public function rolByIdC($idRol)
    {
        $datos = gestionModel::rolByIdM($idRol);

        $datos = $datos->fetch_all(MYSQLI_ASSOC);

        $data = json_encode($datos, JSON_UNESCAPED_UNICODE);

        return $data;
    }

    /**
     * 
     */
    public function typeDocByIdC($idTypeDoc)
    {
        $datos = gestionModel::typeDocByIdM($idTypeDoc);

        $datos = $datos->fetch_all(MYSQLI_ASSOC);

        $data = json_encode($datos, JSON_UNESCAPED_UNICODE);

        return $data;
    }

    /**
     *
     */
    public function actualizarUsuarioC()
    {
        $id = $_POST['id'];
        $idRol = $_POST['idRol'];
        $userName = $_POST['userName'];
        $idTypeDoc = $_POST['idTypeDoc'];
        $numDoc = $_POST['numDoc'];
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];

        $datosId = $this->userByIdC($id);
        $image = "";

        foreach ($datosId as $user) {}

        if ($_FILES['image']['name']) {
            $dir = "../assets/img/perfil/";
            $nombreArchivo = $_FILES['image']['name'];
            $tipo = $_FILES['image']['type'];
            $tipo = strtolower($tipo);
            $extension = substr($tipo, strpos($tipo, '/') + 1);

            // Generar un nuevo nombre para el archivo
            $nuevoNombreArchivo = $userName . '-' . $id . '.' . $extension;

            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            move_uploaded_file($_FILES['image']['tmp_name'], $dir . $nuevoNombreArchivo);

            $directorio = $dir . $nuevoNombreArchivo;

            $image = substr($directorio, 3);
        } else {
            $image = $user['image'];
        }

        $datosU = [
            "id" => $id,
            "idRol" => $idRol,
            "userName" => $userName,
            "idTypeDoc" => $idTypeDoc,
            "numDoc" => $numDoc,
            "name" => $name,
            "lastName" => $lastName,
            "email" => $email,
            "telephone" => $telephone,
            "image" => $image
        ];

        // Ejecuta la función agregarPersonal obteniendo el array de datos
        $addProducto = gestionModel::updateUserM($datosU);

        if ($addProducto >= 1) { /* Si la consulta se ejecuta correctamente */
            // Dará una alerta de éxito
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Usuario actualizado",
                "Texto" => "El usuario se actualizó correctamente en el sistema",
                "Tipo" => "success"
            ];
        } else {
            // Dará una alerta de error
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No hemos podido actualizar al usuario",
                "Tipo" => "error"
            ];
        }

        return mainModel::alert($alerta);
    }

    public function deleteUserByIdC()
    {
        $id = $_POST['id'];

        $delete = gestionModel::deleteUserByIdM($id);

        if ($delete >= 1) { /* Si la consulta se ejecuta correctamente */
            // Dará una alerta de éxito
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Usuario eliminado",
                "Texto" => "El usuario se eliminó correctamente en el sistema",
                "Tipo" => "success"
            ];
        } else {
            // Dará una alerta de error
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No hemos podido eliminar al usuario",
                "Tipo" => "error"
            ];
        }

        return mainModel::alert($alerta);
    }

    public function validarNumDoc()
    {
        $numDoc = strval($_POST['numDoc']);

        if (strlen($numDoc) == 8) {
            $validaDni = mainModel::validarDni($numDoc);
            return $validaDni;
        } else if (strlen($numDoc) == 11) {
            $validaRuc = mainModel::validarRuc($numDoc);
            return $validaRuc;
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Número no valido",
                "Texto" => "Cantidad de dígitos no valido",
                "Tipo" => "error"
            ];

            return mainModel::alert($alerta);
        }
    }

    public function crearUsuarioC()
    {
        $conexion = Connection::connect();

        $idRol = $_POST['idRol'];
        $idTypeDoc = $_POST['idTypeDoc'];
        $numDoc = $_POST['numDoc'];
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];

        $image = "assets/img/perfil/sin-fotografia.png";
        $userName = mainModel::generateUserName($name, $lastName, $numDoc);
        $password = mainModel::encryptePass($_POST['numDoc']);

        $datosU = [
            "idRol" => $idRol,
            "idTypeDoc" => $idTypeDoc,
            "numDoc" => $numDoc,
            "name" => $name,
            "lastName" => $lastName,
            "email" => $email,
            "userName" => $userName,
            "password" => $password,
            "image" => $image,
            "telephone" => $telephone
        ];

        // Ejecuta la función agregarPersonal obteniendo el array de datos
        $addProducto = gestionModel::createUserM($datosU);

        if ($addProducto >= 1) { /* Si la consulta se ejecuta correctamente */
            // Dará una alerta de éxito
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Usuario agregado",
                "Texto" => "El usuario se agregó correctamente en el sistema",
                "Tipo" => "success"
            ];
        } else {
            // Dará una alerta de error
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No hemos podido agregar al usuario",
                "Tipo" => "error"
            ];
        }

        return mainModel::alert($alerta);
    }
}
