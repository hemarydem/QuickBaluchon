<?php
include ("./../../utils/db.php");
function insertDeposit(string $tab,int $idDepot, int $idUser,int $active, array $keyValues) {
    //flagation(1);
    $db = getDataBaseConnection();
    $sql = "INSERT INTO DEPOSIT(idDepot, idUser, active) VALUES (?,?,?)";
    $params = [ $idDepot,  $idUser, $active];
    return dataBaseInsertForMixePrimaryKey($db,  $sql, $params, $tab, $keyValues);
}
