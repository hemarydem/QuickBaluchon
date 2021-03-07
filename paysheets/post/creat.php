<?php

include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
$intKey = [
    "total",
    "km",
    "nbColis",
    "idUser"
];
countJsonObjElem($data, 5);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);         // cast elements
echo insertPaysheet(
    $data->{"total"},
    $data->{"km"},
    $data->{"month"},
    $data->{"nbColis"},
    $data->{"idUser"});