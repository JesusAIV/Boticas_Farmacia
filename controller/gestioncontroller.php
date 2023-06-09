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
class gestionController extends gestionModel{
    /**
     * Funcion recibe el query de la funcion userByIdM
     *
     * @param int $idUser
     * @return array Datos del usuario
     */
    public function userByIdC($idUser){
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

    public function paginationUsers($idUser) {
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $cantidad = 10;

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
                <table class="table_usuarios">
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
                    <tr class="tr-tbody_usuarios">
                        <td class="td_usuarios">'.$registro['id'].'</td>
                        <td class="td_usuarios">'.$registro['rol'].'</td>
                        <td class="td_usuarios">'.$registro['numDoc'].'</td>
                        <td class="td_usuarios">'.$registro['name'].' '.$registro['lastName'].'</td>
                        <td class="td_usuarios">'.$registro['userName'].'</td>
                        <td class="td_usuarios">'.$registro['email'].'</td>
                        <td class="td_usuarios">'.$registro['telephone'].'</td>
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
        </div>
        <div class="container_pagination">
            <div class="pagination">
        ';

        if ($pagina > 1) {
            $tabla .= '
                <div class="pagination_control pagination_previous">
                    <a href="'.SERVERURL.'gestion/usuarios?pagina='.($pagina-1).'" class="previous">Anterior</a>
                </div>
            ';
        }

        $tabla .= '<div class="pagination_numbers">';

        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $pagina) {
                $tabla .= '<a href="'.SERVERURL.'gestion/usuarios?pagina='.$i.'" class="number number_active">'.$i.'</a>';
            } else {
                $tabla .= '<a href="'.SERVERURL.'gestion/usuarios?pagina='.$i.'" class="number">'.$i.'</a>';
            }
        }

        $tabla .= '</div>';

        if ($pagina < $totalPaginas) {
            $tabla .= '
                <div class="pagination_control pagination_next">
                    <a href="'.SERVERURL.'gestion/usuarios?pagina='.($pagina + 1).'" class="next">Siguiente</a>
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
                    <a href="'.SERVERURL.'gestion/usuarios?pagina='.(1).'" class="error_registro">Ir a pagina 1</a>
                    </td>
                </tr>
            ';
        }



        return $tabla;
    }

}