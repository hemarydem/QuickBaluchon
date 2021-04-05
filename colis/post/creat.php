<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
$intKey = [
    "sendingStatut",
    "mode",
    "idRecipient",
    "idDelivery",
    "idUser",
    "idDepot",
    "idCost",
    "idExpressCost"
];
countJsonObjElem($data, 14);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);        // cast elements
insertColis(
    "COLIS",
    $data->{"date"},
    $data->{"adresse"},
    $data->{"codePostale"},
    $data->{"recipientMail"},
    $data->{"weight"},
    $data->{"volume"},
    $data->{"sendingStatut"},
    $data->{"mode"},
    $data->{"idRecipient"},
    $data->{"idDelivery"},
    $data->{"idUser"},
    $data->{"idDepot"},
    $data->{"idCost"},
    $data->{"idExpressCost"});

