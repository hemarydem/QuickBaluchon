<?php

include("./../../utils/db.php");
function insertOwn(string $tab, int $idVehicule, int $idUser,array $keyValues) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO own( idVehicule, idUser) VALUES (?,?)";
    $params = [$idVehicule, $idUser];
    return dataBaseInsertForMixePrimaryKey($db, $sql, $params, $tab, $keyValues);
}

function updateOwn( int $total, int  $km, string $month, int $nbColis, int $idUser, int $id ) {
    $db = getDataBaseConnection();
    $sql = "UPDATE paysheet SET total = ?, km = ?, month = ?, nbColis = ?, idUser = ? WHERE id=?";
    $params = [$total,  $km,   $month, $nbColis, $idUser, $id];
    return dataBaseInsert($db,  $sql, $params);
}
