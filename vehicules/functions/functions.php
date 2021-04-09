<?php
include("./../../utils/db.php");
function insertVehicules(string $tabName ,string $imatriculation, int $nbColis, int $volumeMax, int $weightMax) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO VEHICULE( imatriculation, nbColis, volumeMax, weightMax) VALUES (?,?,?,?)";
    $params = [$imatriculation, $nbColis, $volumeMax, $weightMax];
    return dataBaseInsert($db, $sql, $params, $tabName);
}

