<?php
header("Access-Control-Allow-Origin: *");
if(!empty($_FILES['fileAjax'] ?? null)) {
    $acceptable = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif'
    ];
    //print_r($_FILES);

    if(!in_array( $_FILES['fileAjax']['type'], $acceptable ) ) { 
        header("Content-Type: application/json");
        echo json_encode(["message"=> "invalide file"]);
        exit(1);
    }
    $maxsize = 1024 * 1024; 
    if($_FILES['fileAjax']['size'] > $maxsize) { // 1Mo  //check file weight
        header("Content-Type: application/json");
        echo json_encode(["message"=> "file is too heavy"]);
        exit(1);
    }
    $path = './profile/licence/';
    if(!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    $imagename = $_FILES['fileAjax']['name'];
    $temp = explode('.', $imagename);
    $extension = end($temp);
    $timestamp = time();
    $imagename = 'licence_profile-'. $timestamp . '.' . $extension;
    $pathImage = $path . $imagename;
    move_uploaded_file( $_FILES['fileAjax']['tmp_name'], $pathImage );
    
    header("Content-Type: application/json");
    echo json_encode(["pathImage"=> $pathImage]);
    exit(0);
}