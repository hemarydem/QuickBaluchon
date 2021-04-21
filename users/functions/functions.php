<?php
include ("./../../utils/db.php");
function insertUser( string $tabName, string $nom, string $prenom, string  $mail, string  $adresse, string $numSiret, string $password, string $tel, int $driverLicence, int $statut, int $busy, int $zoneMaxDef) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO USER( nom, prenom, mail, adresse, numSiret, password, tel, driverLicence, statut, busy, zoneMaxDef) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $params = [ $nom,  $prenom,   $mail,   $adresse,  $numSiret,  $password,  $tel, $driverLicence, $statut, $busy, $zoneMaxDef];
    return dataBaseInsert($db,  $sql, $params, $tabName);
}
