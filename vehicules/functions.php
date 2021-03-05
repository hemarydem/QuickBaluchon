<?php

$nVhcl = json_decode($_POST, true);

if(isset($_POST['model']) && isset($_POST['capacity'])) {
    $model = $_POST['model'];
    $capacity = $_POST['capacity'];
    $lastId = insertPlane($model, $capacity);
    if($lastId) {
        $plane = getPlaneById($lastId);
        if($plane) {
            http_response_code(201);
            header('Content-Type: application/json');
            echo json_encode($plane);
        } else {
            http_response_code(500);
        }
    } else {
        http_response_code(500);
    }
} else {
    http_response_code(400); // BAD_REQUEST
}