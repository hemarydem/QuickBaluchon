<?php
include ("./../../utils/db.php");
function insertPaysheet( string $tab, int $total, int  $km, string $month, int $nbColis, int $idUser) :?string {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO PAYSHEET( total, km, month, nbColis, idUser) VALUES (?,?,?,?,?)";
    $params = [ $total,  $km,   $month, $nbColis, $idUser];
    return dataBaseInsert($db,  $sql, $params, $tab);
}


