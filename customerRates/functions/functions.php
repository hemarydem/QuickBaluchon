<?php
include ("./../../utils/db.php");
function insertCustomerrate(string $tab, int $weight, int $cost, int $expressCost, int $mode,array $keyValues) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO customerrate(weight, cost, expressCost, mode) VALUES (?,?,?,?)";
    $params = [ $weight,  $cost, $expressCost, $mode];
    return dataBaseInsertForMixePrimaryKey($db,  $sql, $params, $tab,$keyValues );
}
/*
 * (PDO $connect, string $sql, array $params, string $tabName,array $keyValues)
function insertOwn(string $tab, int $idVehicule, int $idUser,array $keyValues) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO own( idVehicule, idUser) VALUES (?,?)";
    $params = [$idVehicule, $idUser];
    return dataBaseInsertForMixePrimaryKey($db, $sql, $params, $tab, $keyValues);
}*/