<?php
include("./../../utils/db.php");
function insertVehicules(string $imatriculation, int $nbColis, int $volumeMax, int $weightMax)
{
    $db = getDataBaseConnection();
    $sql = "INSERT INTO vehicule( imatriculation, nbColis, volumeMax, weightMax) VALUES (?,?,?,?)";
    $params = [$imatriculation, $nbColis, $volumeMax, $weightMax];
    return dataBaseInsert($db, $sql, $params);
}