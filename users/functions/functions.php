<?php
include ("./../../utils/db.php");
function insertUser( string $tabName, string $nom, string $prenom, string  $mail, string  $adresse, string $numSiret, string $password, string $tel, int $driverLicence, int $statut, int $busy, int $zoneMaxDef) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO user( nom, prenom, mail, adresse, numSiret, password, tel, driverLicence, statut, busy, zoneMaxDef) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $params = [ $nom,  $prenom,   $mail,   $adresse,  $numSiret,  $password,  $tel, $driverLicence, $statut, $busy, $zoneMaxDef];
    return dataBaseInsert($db,  $sql, $params, $tabName);
}

function updateUser( string $nom, string $prenom, string  $mail, string  $adresse, string $numSiret, string $password, string $tel, int $driverLicence, int $statut, int $busy, int $zoneMaxDef, int $id ) {
    $db = getDataBaseConnection();
    $sql = "UPDATE user SET nom = ?, prenom = ?, mail = ?, adresse = ?, numSiret = ?, password = ?, tel = ?, driverLicence = ?, statut = ?, busy = ?, zoneMaxDef = ? WHERE id=?";
    $params = [ $nom,  $prenom,   $mail,   $adresse,  $numSiret,  $password,  $tel, $driverLicence, $statut, $busy, $zoneMaxDef, $id];
    return dataBaseInsert($db,  $sql, $params);
}

/*
 * <?php
include ("./../../utils/db.php");
function insertUser( string $nom, string $prenom, string  $mail, string  $adresse, string $numSiret, string $password, string $tel, int $driverLicence, int $statut, int $busy, int $zoneMaxDef) {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO user( nom, prenom, mail, adresse, numSiret, password, tel, driverLicence, statut, busy, zoneMaxDef) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $params = [ $nom,  $prenom,   $mail,   $adresse,  $numSiret,  $password,  $tel, $driverLicence, $statut, $busy, $zoneMaxDef];
    return dataBaseInsert($db,  $sql, $params);
}*/