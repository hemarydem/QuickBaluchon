<?php
include("./../../utils/db.php");
function insertVehicules(string $tabName ,string $imatriculation, int $nbColis, int $volumeMax, int $weightMax) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO vehicule( imatriculation, nbColis, volumeMax, weightMax) VALUES (?,?,?,?)";
    $params = [$imatriculation, $nbColis, $volumeMax, $weightMax];
    return dataBaseInsert($db, $sql, $params, $tabName);
}

function updateVehicule(string $imatriculation, int $nbColis, int $volumeMax, int $weightMax) {
    $db = getDataBaseConnection();
    $sql = "UPDATE vehicule SET imatriculation = ?, nbColis = ?, volumeMax = ?, weightMax = ? WHERE id=?";
    $params = [$imatriculation, $nbColis, $volumeMax, $weightMax, $id];
    return dataBaseInsert($db,  $sql, $params);
}
