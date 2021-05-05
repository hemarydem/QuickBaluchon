<?php
include("./../../chckFnctns/chckFnctns.php");
include("./../../listfnctns/listfnctns.php");
include("../../utils/db.php");
$tabArr = [
    "BILL",
    "CHECKDELIVERY",
    "COLIS",
    "CUSTOMERRATE",
    "DELIVERY",
    "DELIVERYOBJECTIF",
    "DELIVERYRATE",
    "DEPOSIT",
    "DEPOT",
    "OWN",
    "PAYSHEET",
    "RECIPIENT",
    "USER",
    "VEHICULE"];


$tabArr = [
    "BILL"=> ["cost","idUser"],
    "CHECKDELIVERY"=> ["idDelivery","idUser"],
    "COLIS"=> ["dDate" ,"adresse", "codePostale", "recipientMail", "weight", "volume", "sendingStatut", "mode", "idRecipient", "idDelivery","idUser","idDepot","idCost","idExpressCost"],
    "CUSTOMERRATE"=> ["weight", "cost", "expressCost", "mode"],
    "DELIVERY"=> ["volume", "weight", "distance"],
    "DELIVERYOBJECTIF"=> ["palier", "idUser"],
    "DELIVERYRATE"=> ["costByKm", "costByColis", "primeWeight", "idUser"],
    "DEPOSIT"=> ["idDepot", "idUser"],
    "DEPOT"=> ["longitude", "latitude", "ville", "adresse", "codePostale"],
    "OWN"=> ["idVehicule", "idUser"],
    "PAYSHEET"=> ["total", "km", "month", "nbColis", "idUser"],
    "RECIPIENT"=> ["mail", "nom", "prenom"],
    "USER"=> ["nom", "prenom", "mail", "adresse", "numSiret", "password", "tel", "driverLicence", "statut", "busy", "zoneMaxDef"],
    "VEHICULE"=> ["imatriculation", "nbColis", "volumeMax", "weightMax"]
];



if (isset($_GET)) {
    $bdd = getDataBaseConnection();
    $sql = "SELECT
                   VEHICULE.id,
                   VEHICULE.imatriculation,
                   VEHICULE.nbColis,
                   VEHICULE.volumeMax,
                   VEHICULE.weightMax 
            FROM 
                    VEHICULE 
            INNER JOIN
                    OWN 
            WHERE 
                    OWN.idUser = 3";
    $statement = $bdd->prepare($sql);
    $success = $statement->execute([]);
    if($success) {
        $resull = $statement->fetchAll(PDO::FETCH_ASSOC);
        print_r($resull);
    }
}
