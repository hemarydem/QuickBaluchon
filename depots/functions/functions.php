<?php
include ("./../../utils/db.php");
function insertDepot( int $coordo, string $ville, string  $adresse, string  $codePostale) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO depot(coordo, ville, adresse, codePostale) VALUES (?,?,?,?)";
    $params = [ $coordo,  $ville,   $adresse,   $codePostale];
    return dataBaseInsert($db,  $sql, $params);
}

