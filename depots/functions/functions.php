<?php
include ("./../../utils/db.php");
function insertDepot(string $tab, float $longitude, float $latitude, string $ville, string  $adresse, string  $codePostale) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO depot(longitude, latitude, ville, adresse, codePostale) VALUES (?,?,?,?,?)";
    $params = [$longitude, $latitude,  $ville,   $adresse,   $codePostale];
    return dataBaseInsert($db,  $sql, $params, $tab);
}


