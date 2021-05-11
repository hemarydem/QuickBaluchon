<?php
include("./../functions/functions.php");
include("./../../chckFnctns/chckFnctns.php");
include("./../../listfnctns/listfnctns.php");
header("Access-Control-Allow-Origin: *");
if(isset($_GET)) {
    $tab = "PAYSHEET";
    $max =  execRequestForCount($tab);
    header("Content-Type: application/json");
    echo json_encode(["total"=>$max]);
} else {
    http_response_code(500);
}