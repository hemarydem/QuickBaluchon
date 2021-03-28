<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
$intKey = [
    "idVehicule",
    "idUser"
];
countJsonObjElem($data, 2);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);         // cast elements
insertOwn(
     "own",
    $data->{"idVehicule"},
    $data->{"idUser"},
    [
        "idVehicule" => $data->{"idVehicule"},
        "idUser" => $data->{"idUser"}
    ]);
