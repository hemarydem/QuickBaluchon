<?php
include ("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
$content = file_get_contents('php://input');
$data = json_decode($content, true);
$intKey = [
    "driverLicence",
    "statut",
    "busy",
    "zoneMaxDef",
    "id"
];
//countJsonObjElem($data, 12);   // must have 11 elements
//areSetJsonObjElem($data);                   // elements are init
strToIntAssiArrayElem($data,$intKey);         // cast elements

buildsUpdateAndattributs()
/*
updateUser(
    $data->{"nom"},
    $data->{"prenom"},
    $data->{"mail"},
    $data->{"adresse"},
    $data->{"numSiret"},
    $data->{"password"},
    $data->{"tel"},
    $data->{"driverLicence"},
    $data->{"statut"},
    $data->{"busy"},
    $data->{"zoneMaxDef"},
    $data->{"id"});

