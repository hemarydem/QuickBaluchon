<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
$intKey = [
    "costByKm",
    "costByColis",
    "primeWeight",
    "idUser"
];
countJsonObjElem($data, 4);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);         // cast elements
insertDeliveryRates(
    "deliveryRate",
    $data->{"costByKm"},
    $data->{"costByColis"},
    $data->{"primeWeight"},
    $data->{"idUser"});