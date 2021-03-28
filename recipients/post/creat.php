<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
countJsonObjElem($data, 3);   // must have 11 elements
areSetJsonObjElem($data);                   // elements are init
echo insertRecipient(
    "recipient",
    $data->{"mail"},
    $data->{"nom"},
    $data->{"prenom"});