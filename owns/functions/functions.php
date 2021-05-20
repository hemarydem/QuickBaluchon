<?php

include("./../../utils/db.php");
function insertOwn(string $tab, int $idVehicule, int $idUser,int $active,array $keyValues) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO OWN( idVehicule, idUser, active) VALUES (?,?,?)";
    $params = [$idVehicule, $idUser,$active];
    return dataBaseInsertForMixePrimaryKey($db, $sql, $params, $tab, $keyValues);
}
