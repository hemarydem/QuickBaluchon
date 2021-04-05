<?php
include ("./../../utils/db.php");
function insertBill(string $tab, string $cost, int $idUser) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO bill(cost, idUser) VALUES (?,?)";
    $params = [ $cost,  $idUser];
    return dataBaseInsert($db,  $sql, $params, $tab);
}