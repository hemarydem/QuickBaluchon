<?php
include("./../../utils/db.php");
session_start();
function insertVehicules(string $tabName ,string $imatriculation, int $nbColis, int $volumeMax, int $weightMax, int $employ, int $active) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO VEHICULE( imatriculation, nbColis, volumeMax, weightMax, employ, active) VALUES (?,?,?,?,?,?)";
    $params = [$imatriculation, $nbColis, $volumeMax, $weightMax, $employ, $active];
    return dataBaseInsert($db, $sql, $params, $tabName);
}

