<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
$intKey = [
    "volume",
    "weight",
    "distance"
];
countJsonObjElem($data, 3);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);         // cast elements
echo insertDelivery(
    $data->{"volume"},
    $data->{"weight"},
    $data->{"distance"});