<?php

include("./../functions/functions.php");
include("./../../chckFnctns/chckFnctns.php");
include("./../../listfnctns/listfnctns.php");
$content = file_get_contents('php://input');
$data = json_decode($content);
if (isset($data->{'id'})) {
    $id = intval($data->{'id'});
    $sql = "DELETE FROM user WHERE id = ?";
    $array = array($id);
    $row = execRequestDelete($sql, $array); //db.php
    $json = json_encode($row);
    header("Content-Type: application/json");
    print_r($json);
} else {
    http_response_code(500);
}

