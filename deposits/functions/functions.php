<?php
include ("./../../utils/db.php");
function insertDeposit(int $idDepot, int $idUser) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO deposit(idDepot, idUser) VALUES (?,?)";
    $params = [ $idDepot,  $idUser];
    return dataBaseInsert($db,  $sql, $params);
}

