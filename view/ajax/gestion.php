<?php
$ajax = true;
session_start();

require_once "../../controller/gestioncontroller.php";

$gestion = new gestionController();

if (!empty($_POST['action'])) {
    if ($_POST['action'] == 'viewUser') {
        $mData = $gestion->userByIdC($_POST['id']);
        header("Content-Type: application/json");
        echo json_encode($mData, JSON_UNESCAPED_UNICODE);
    }
    if ($_POST['action'] == 'listRol') {
        echo $gestion->ListRolC();
    }
    if ($_POST['action'] == 'listTypeDoc') {
        echo $gestion->ListTypeDocC();
    }

    if ($_POST['action'] == 'rolSelect') {
        echo $gestion->rolByIdC($_POST['idRol']);
    }
    if ($_POST['action'] == 'TypeDocSelect') {
        echo $gestion->typeDocByIdC($_POST['idTypeDoc']);
    }

    if ($_POST['action'] == 'deleteUser') {
        echo $gestion->deleteUserByIdC();
    }
    if ($_POST['action'] == 'verifyNumDoc') {
        echo $gestion->validarNumDoc();
    }
} else {
    if (isset($_POST['updateUId'])) {
        echo $gestion->actualizarUsuarioC();
    } elseif (isset($_POST['adduser'])) {
        echo $gestion->crearUsuarioC();
    }
}
