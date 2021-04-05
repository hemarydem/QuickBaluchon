<?php

include("./../../utils/db.php");
function insertOwn(string $tab, int $idVehicule, int $idUser,array $keyValues) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO own( idVehicule, idUser) VALUES (?,?)";
    $params = [$idVehicule, $idUser];
    return dataBaseInsertForMixePrimaryKey($db, $sql, $params, $tab, $keyValues);
}
