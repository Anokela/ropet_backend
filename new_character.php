<?php
require_once './Inc/functions.php';
require_once './Inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$new_gamenmb = filter_var($input->pelinro,FILTER_SANITIZE_STRING);
$new_charname = filter_var($input->hahmon_nimi,FILTER_SANITIZE_STRING);
$new_playername = filter_var($input->pelaaja_nimi,FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $db->beginTransaction();
    $query = $db->prepare("INSERT INTO hahmo (pelinro,pelaaja_nimi,hahmon_nimi) values (:pelinro, :pelaaja_nimi,:hahmon_nimi)");
    $query->bindValue(':pelinro',$new_gamenmb,PDO::PARAM_INT);
    $query->bindValue(':pelaaja_nimi',$new_playername,PDO::PARAM_STR);
    $query->bindValue(':hahmon_nimi',$new_charname,PDO::PARAM_STR);

    $query->execute();

    header ('HTTP/1.1 200 OK');
    $data = array('hahmonro' => $db->lastInsertId(), 'pelinro' => $new_gamenmb, 'pelaaja_nimi' => $new_playername, 'hahmon_nimi' => $new_charname);
    echo json_encode($data);

    $db->commit();
} 

catch (PDOException $pdoex) {
    returnError($pdoex);
}