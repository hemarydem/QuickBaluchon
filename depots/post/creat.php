<?php

include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
$intKey = [
    "coordo"
];
countJsonObjElem($data, 4);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);         // cast elements
insertDepot(
    $data->{"coordo"},
    $data->{"ville"},
    $data->{"adresse"},
    $data->{"codePostale"});