<?php
include ("./../../utils/db.php");
function insertCustomerrate(int $weight, int $cost, int $expressCost, int $mode) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO customerrate(weight, cost, expressCost, mode) VALUES (?,?,?,?)";
    $params = [ $weight,  $cost, $expressCost, $mode];
    return dataBaseInsert($db,  $sql, $params);
}

