<?php
include("./../functions/functions.php");
include("./../../chckFnctns/chckFnctns.php");
include("./../../listfnctns/listfnctns.php");
checIfsessionStarted();
if (isset($_GET)) {
    /* if(isset($_GET['tokenApi'])) {
         chekIfRequestFromShield($_GET['tokenApi']);
         unset($_GET['tokenApi']);
     } else {
         erro400NotConnectJsonMssg( "token api is not set");
     }*/
    header("Access-Control-Allow-Origin: *");
    checkStringsArray($_GET, 1);

    $tab = "COLIS";
    $sql = buildsSelectattributs($_GET, $tab);//listfnctns.php
    $params = buildParams($_GET);
    $rows = execRequest($sql, $params);
    if ($rows == null) {
        header("Content-Type: application/json");
        echo json_encode(["message" => "no result found"]);
        exit(1);
    }
    $json = json_encode($rows);
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}

















/*
include("./../functions/functions.php");
include("./../../chckFnctns/chckFnctns.php");
include("./../../listfnctns/listfnctns.php");
header("Access-Control-Allow-Origin: *");
if (isset($_GET)) {
    if (isset($_GET["id"])) {
        $id = intval($_GET["id"]);
    } else {
        erroJsonMssg("error id is missing");
    }
    $sql = "SELECT COLIS.dDate , COLIS.adresse, COLIS.codePostale, COLIS.recipientMail, COLIS.weight, COLIS.volume, COLIS.sendingStatut, COLIS.mode, COLIS.idRecipient, COLIS.idDelivery, COLIS.idUser, COLIS.idDepot, COLIS.idCost, COLIS.idExpressCost FROM COLIS INNER JOIN OWN ON OWN.idVehicule=VEHICULE.id AND OWN.idUser=?";
    $rows = execRequestGetALLResults($sql, [$id]);
    $json = json_encode($rows);
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}*/
