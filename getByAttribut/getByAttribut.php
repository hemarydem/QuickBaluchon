<?php
include("./../functions/functions.php");
include("./../../chckFnctns/chckFnctns.php");
include("./../../listfnctns/listfnctns.php");
$tabArr = [
    "bill" => ["cost", "idUser"], // code = 1
    "CHECKDELIVERY" => ["idDelivery", "idUser"], // code = 2
    "colis" => ["dDate" ,"adresse", "codePostale", "recipientMail", "weight", "volume", "sendingStatut", "mode", "idRecipient", "idDelivery","idUser","idDepot","idCost","idExpressCost"],  // code = 3
    "CUSTOMERRATE" => ["volume", "weight", "distance"], // code = 4
    "DELIVERY" => ["volume", "weight", "distance"], // code = 5
    "DELIVERYOBJECTIF" => ["palier", "idUser"], // code = 6
    "DELIVERYRATE" => ["weight", "cost", "expressCost", "mode"], // code = 7
    "DEPOSIT" => ["idDepot", "idUser"], // code = 8
    "DEPOT" => ["longitude", "latitude", "ville", "adresse", "codePostale"], // code = 9
    "own" => ["idVehicule", "idUser"], // code = 10
    "paysheet" => ["total", "km", "month", "nbColis", "idUser"], // code = 11
    "recipient" => ["mail", "nom", "prenom"], // code = 12
    "user"  => ["nom", "prenom", "mail", "adresse", "numSiret", "password", "tel", "driverLicence", "statut", "busy", "zoneMaxDef"], // code = 13
    "vehicule" => ["imatriculation", "nbColis", "volumeMax", "weightMax"]  // code = 14
];
if (isset($_GET)) {
    $id = intval($_GET['id']);
    $tab = "USER";
    if (!isExistInDb($id, $tab)) {
        http_response_code(400);
        exit(1);
    }
    //echo $id;
    unset($_GET['id']);
    $sql = buildsSelectAndattributs($_GET, $tab);//listfnctns.php
    $sql .= " WHERE id = ?";
    //echo $sql;
    $rows = dataBaseFindOne($sql, (int)$id); //db.php
    echo $_SESSION["token"];
    $json = json_encode($rows);
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}