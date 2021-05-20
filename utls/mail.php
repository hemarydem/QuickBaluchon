<?php
//need, id, mail
$content = file_get_contents('php://input');
$data = json_decode($content, true);

print_r($data);
if(isset($data["id"]) && isset($data["mail"])){
    $to = $data["mail"];
    $token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);
    $from = 'quickBaluchon';
    $name = 'quickBaluchon';
    $subject = 'Confirmation inscription';
    $link = 'https://quickbaluchonservice.site/validationMail/validationMail.php?mail=' . $data["mail"] . '&token=' . $token . "&id=" . $data["id"];
    $message = '<a href="' . $link . '"> Clickez sur ce lien pour valider votre inscription </a>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $headers .= 'From: ' . $from. ' <' . $name . '>';
    $result = mail( $to, $subject, $message, $headers );
    $dataSending = [
        "id" => $data["id"],
        "tokenEmail" => $token
    ];
    $urlBase = "https://quickbaluchonservice.site/api/QuickBaluchonusers/post/update.php";
    $ch = curl_init($urlBase);
    $payload = json_encode($dataSending);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
    if($result == true) {
        header("Content-Type: application/json");
        echo json_encode(["message"=> true]);
    } else {
        header("Content-Type: application/json");
        echo json_encode(["message"=> false]);
    }
}else{
    header("Content-Type: application/json");
    echo json_encode(["message"=> "it miss data"]);
    exit;
}
?>