<?php
include ("./../../utils/db.php");
function insertDelivery(string $tab,int $volume, int $weight, int  $distance) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO delivery(volume, weight, distance) VALUES (?,?,?)";
    $params = [ $volume,  $weight,   $distance];
    return dataBaseInsert($db,  $sql, $params, $tab);
}

