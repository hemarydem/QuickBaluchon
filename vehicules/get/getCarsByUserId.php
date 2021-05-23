<?php
include("./../functions/functions.php");
include ("./../../chckFnctns/chckFnctns.php");
include ("./../../listfnctns/listfnctns.php");
header("Access-Control-Allow-Origin: *");
if(isset($_GET)) {
    if(isset($_GET["id"])) {
        $id = intval($_GET["id"]);
    } else {
        erroJsonMssg("error id is missing");
    }
    if(isset($_GET["active"])) {
        $active = intval($_GET["active"]);
    } else {
        erroJsonMssg("error id is missing");
    }
    $sql = "SELECT VEHICULE.id, VEHICULE.imatriculation, VEHICULE.nbColis, VEHICULE.volumeMax, VEHICULE.weightMax, VEHICULE.employ, VEHICULE.active FROM VEHICULE AND VEHICULE.active=? INNER JOIN OWN ON OWN.idVehicule=VEHICULE.id AND OWN.idUser=?";
    $rows = execRequestGetALLResults( $sql, [$active,$id]);
    $json = json_encode($rows);
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}

