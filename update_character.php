<?php
require_once './inc/functions.php';
require_once './inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$pelaaja_nimi = filter_var($input->pelaaja_nimi,FILTER_SANITIZE_STRING);
$hahmon_nimi = filter_var($input->hahmon_nimi,FILTER_SANITIZE_STRING);
$hahmonro = filter_var($input->hahmonro,FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $query = $db->prepare("UPDATE hahmo SET pelaaja_nimi=:pelaaja_nimi,hahmon_nimi=:hahmon_nimi where hahmonro=:hahmonro");
    $query2 = $db->prepare("UPDATE tila SET hahmon_nimi=:hahmon_nimi where hahmonro=:hahmonro");
    $query->bindValue(':pelaaja_nimi',$pelaaja_nimi,PDO::PARAM_STR);
    $query->bindValue(':hahmon_nimi',$hahmon_nimi,PDO::PARAM_STR);
    $query->bindValue(':hahmonro',$hahmonro,PDO::PARAM_INT);

    $query2->bindValue(':hahmonro',$hahmonro,PDO::PARAM_INT);
    $query2->bindValue(':hahmon_nimi',$hahmon_nimi,PDO::PARAM_STR);


    $query->execute();
    $query2->execute();

    header ('HTTP/1.1 200 OK');
    $data = array('pelaaja_nimi' => $pelaaja_nimi, 'hahmon_nimi' => $hahmon_nimi, 'hahmonro' => $hahmonro);
    echo json_encode($data);

} catch (PDOException $pdoex) {
    returnError($pdoex);
}