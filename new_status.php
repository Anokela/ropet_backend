<?php
require_once './Inc/functions.php';
require_once './Inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$luontipvm = filter_var($input->luontipvm,FILTER_SANITIZE_STRING);
$hahmonro = filter_var($input->hahmonro,FILTER_SANITIZE_STRING);
$hahmon_nimi = filter_var($input->hahmon_nimi,FILTER_SANITIZE_STRING);
$tila = filter_var($input->tila,FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $db->beginTransaction();
    $query = $db->prepare("INSERT INTO tila (luontipvm,hahmonro,tila, hahmon_nimi) values (:luontipvm,:hahmonro,:tila, :hahmon_nimi)");
    $query->bindValue(':luontipvm',$luontipvm,PDO::PARAM_STR);
    $query->bindValue(':hahmonro',$hahmonro,PDO::PARAM_INT);
    $query->bindValue(':tila',$tila,PDO::PARAM_STR);
    $query->bindValue(':hahmon_nimi',$hahmon_nimi,PDO::PARAM_STR);
    $query->execute();
    header ('HTTP/1.1 200 OK');
    $data = array('luontipvm' => $luontipvm, 'hahmonro' => $hahmonro, 'tila' => $tila, 'hahmon_nimi' => $hahmon_nimi);
    echo json_encode($data);
    $db->commit();
} 
catch (PDOException $pdoex) {
    returnError($pdoex);
}