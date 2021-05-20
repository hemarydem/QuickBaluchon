<?php
include ("./../../utils/db.php");
session_start();
function insertUser( string $tabName, string $nom, string $prenom, string  $mail, string  $adresse, string $numSiret, string $password, string $tel, int $driverLicence, int $statut, int $busy, int $zoneMaxDef, int $active) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO USER( nom, prenom, mail, adresse, numSiret, password, tel, driverLicence, statut, busy, zoneMaxDef, active) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $params = [ $nom,  $prenom,   $mail,   $adresse,  $numSiret,  $password,  $tel, $driverLicence, $statut, $busy, $zoneMaxDef,$active];
    return dataBaseInsert($db,  $sql, $params, $tabName);
}
