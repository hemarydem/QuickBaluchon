<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../functions/functions.php");
session_start();
$idCheck = intval($_GET['id']);
$sql = buildsDelete("vehicule", $idCheck);
$params = array($idCheck);
if (execRequestDelete($sql, $params)) {
    header('Content-type: Application/json');
    echo json_encode(["success"=>1]);
} else {
    http_response_code(400);
}
