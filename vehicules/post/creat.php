<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
session_start();
$content = file_get_contents('php://input');
$data = json_decode($content);
$intKey = [
    "nbColis",
    "volumeMax",
    "weightMax"
];
countJsonObjElem($data, 4);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);        // cast elements
insertVehicules(
    "VEHICULE",
    $data->{"imatriculation"},
    $data->{"nbColis"},
    $data->{"volumeMax"},
    $data->{"weightMax"});
