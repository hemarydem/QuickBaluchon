<?php
include ("./listfnctns/listfnctns.php");
$where = [];
$params = [];
$listAttribut = [
    "acostByKm" => 1,
    "acostByColis" => 2,
    "aprimeWeight" => 3,
    "aidUser" => 4
];

buildsLIkes($where,$params,$listAttribut);

