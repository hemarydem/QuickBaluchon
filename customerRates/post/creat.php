<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
$intKey = [
    "weight",
    "cost",
    "expressCost",
    "mode"
];
countJsonObjElem($data, 4);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
strToIntJsonObjElem($data, $intKey);         // cast elements
insertCustomerrate(
    "customerRate",
    $data->{"weight"},
    $data->{"cost"},
    $data->{"expressCost"},
    $data->{"mode"},
    [
        "cost"=>$data->{"cost"},
        "expressCost"=>$data->{"expressCost"}
    ]);


