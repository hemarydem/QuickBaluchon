<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");

if(isset($_GET)) {
    $idCheck = intval($_GET['id']);
    $sql = buildsDelete("vehicule", $idCheck);
    $params = array($idCheck);
    if (execRequestDelete($sql, $params)) {
        header("Access-Control-Allow-Origin: *");
        header('Content-type: Application/json');
        echo json_encode(["success"=>1]);
    } else {
        http_response_code(400);
        echo json_encode(["success"=>0]);
    }
} else {
    //echo "error";
    http_response_code(500);
}


