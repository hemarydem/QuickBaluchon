<?php

include("./../../utils/db.php");
function insertOwn(int $idVehicule, int $idUser)
{
    $db = getDataBaseConnection();
    $sql = "INSERT INTO own( idVehicule, idUser) VALUES (?,?)";
    $params = [$idVehicule, $idUser];
    echo "ok";
    return dataBaseInsert($db, $sql, $params);
}

function updatePaysheet( int $total, int  $km, string $month, int $nbColis, int $idUser, int $id ) {
    $db = getDataBaseConnection();
    $sql = "UPDATE paysheet SET total = ?, km = ?, month = ?, nbColis = ?, idUser = ? WHERE id=?";
    $params = [$total,  $km,   $month, $nbColis, $idUser, $id];
    return dataBaseInsert($db,  $sql, $params);
}
