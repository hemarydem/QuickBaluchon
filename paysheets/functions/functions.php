<?php
include ("./../../utils/db.php");
function insertPaysheet( int $total, int  $km, string $month, int $nbColis, int $idUser) :?string {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO paysheet( total, km, month, nbColis, idUser) VALUES (?,?,?,?,?)";
    $params = [ $total,  $km,   $month, $nbColis, $idUser];
    return dataBaseInsert($db,  $sql, $params);
}

function updatePaysheet( int $total, int  $km, string $month, int $nbColis, int $idUser, int $id ) {
    $db = getDataBaseConnection();
    $sql = "UPDATE paysheet SET total = ?, km = ?, month = ?, nbColis = ?, idUser = ? WHERE id=?";
    $params = [$total,  $km,   $month, $nbColis, $idUser, $id];
    return dataBaseInsert($db,  $sql, $params);
}
