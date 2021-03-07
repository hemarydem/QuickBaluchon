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