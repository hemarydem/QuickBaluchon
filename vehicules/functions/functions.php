<?php
include("./../../utils/db.php");
session_start();
function insertVehicules(string $tabName ,string $imatriculation, int $nbColis, int $volumeMax, int $weightMax, int $employ) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO VEHICULE( imatriculation, nbColis, volumeMax, weightMax, employ) VALUES (?,?,?,?)";
    $params = [$imatriculation, $nbColis, $volumeMax, $weightMax, $employ];
    return dataBaseInsert($db, $sql, $params, $tabName);
}

