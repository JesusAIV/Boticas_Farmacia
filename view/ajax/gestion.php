<?php
$ajax = true;
session_start();

require_once "../../controller/gestioncontroller.php";

$gestion = new gestionController();

if ($_POST['action'] == 'viewUser'){
    $mData = $gestion->userByIdC($_POST['id']);
    header("Content-Type: application/json");
    echo json_encode($mData, JSON_UNESCAPED_UNICODE);
}