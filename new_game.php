<?php
require_once './Inc/functions.php';
require_once './Inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$new_game = filter_var($input->pelin_nimi,FILTER_SANITIZE_STRING);
$new_gm = filter_var($input->pelinjohtaja,FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $db->beginTransaction();
    $query = $db->prepare("INSERT INTO peli (pelin_nimi,pelinjohtaja) values (:pelin_nimi,:pelinjohtaja)");
    $query->bindValue(':pelin_nimi',$new_game,PDO::PARAM_STR);
    $query->bindValue(':pelinjohtaja',$new_gm,PDO::PARAM_STR);

    $query->execute();

    header ('HTTP/1.1 200 OK');
    $data = array('pelin_nimi' => $new_game, 'pelinjohtaja' => $new_gm);
    echo json_encode($data);

    $db->commit();
} 

catch (PDOException $pdoex) {
    returnError($pdoex);
}