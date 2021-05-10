<?php
include ("./../../utils/db.php");
function insertRecipient(string $tabName,string $mail, string  $nom, string $prenom) :?string {
    $db = getDataBaseConnection();
    $sql = "INSERT INTO RECIPIENT( mail, nom, prenom) VALUES (?,?,?)";
    $params = [ $mail,  $nom,   $prenom];
    return dataBaseInsert($db,  $sql, $params, $tabName);
}