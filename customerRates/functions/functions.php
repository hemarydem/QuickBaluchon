<?php
include ("./../../utils/db.php");
function insertCustomerrate(string $tab, int $weight, int $cost, int $expressCost, int $mode,array $keyValues) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO customerrate(weight, cost, expressCost, mode) VALUES (?,?,?,?)";
    $params = [ $weight,  $cost, $expressCost, $mode];
    return dataBaseInsertForMixePrimaryKey($db,  $sql, $params, $tab,$keyValues );
}
