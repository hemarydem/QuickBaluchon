<?php
include("./../../utils/db.php");
function insertCheckdelivery(string $tab, int $idDelivery, int $idUser, array $keyValues)
{
    $db = getDataBaseConnection();
    $sql = "INSERT INTO ".$tab."( idVehicule, idUser) VALUES (?,?)";
    $params = [$idDelivery, $idUser];
    return dataBaseInsertForMixePrimaryKey($db, $sql, $params, $tab, $keyValues);
}