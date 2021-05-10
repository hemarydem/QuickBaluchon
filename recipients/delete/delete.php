<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
header("Access-Control-Allow-Origin: *");
if(isset($_GET)) {
    $idCheck = intval($_GET['id']);
    $sql = buildsDelete("RECIPIENT", $idCheck);
    $params = array($idCheck);
    if (execRequestDelete($sql, $params)) {
        header('Content-type: Application/json');
        echo json_encode(["success"=>1]);
    } else {
        http_response_code(400);
    }
}else {
    http_response_code(500);
}
