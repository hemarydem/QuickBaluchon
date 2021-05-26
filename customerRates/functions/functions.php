<?php
include ("./../../utils/db.php");
function insertCustomerrate(string $tab, float $weight, float $cost, float $expressCost, int $mode,array $keyValues) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO CUSTOMERRATE(weight, cost, expressCost, mode) VALUES (?,?,?,?)";
    $params = [ $weight,  $cost, $expressCost, $mode];
    return dataBaseInsertForMixePrimaryKey($db,  $sql, $params, $tab,$keyValues );
}
