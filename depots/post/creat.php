<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
countJsonObjElem($data, 5);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
insertDepot(
    "depot",
    $data->{"longitude"},
    $data->{"latitude"},
    $data->{"ville"},
    $data->{"adresse"},
    $data->{"codePostale"});