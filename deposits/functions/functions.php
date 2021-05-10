<?php
include ("./../../utils/db.php");
function insertDeposit(string $tab,int $idDepot, int $idUser, array $keyValues) {
    //flagation(1);
    $db = getDataBaseConnection();
    $sql = "INSERT INTO DEPOSIT(idDepot, idUser) VALUES (?,?)";
    $params = [ $idDepot,  $idUser];
    return dataBaseInsertForMixePrimaryKey($db,  $sql, $params, $tab, $keyValues);
}
