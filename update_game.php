<?php
require_once './inc/functions.php';
require_once './inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$pelin_nimi = filter_var($input->pelin_nimi,FILTER_SANITIZE_STRING);
$pelinjohtaja = filter_var($input->pelinjohtaja,FILTER_SANITIZE_STRING);
$pelinro = filter_var($input->pelinro,FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $query = $db->prepare("UPDATE peli SET pelin_nimi=:pelin_nimi,pelinjohtaja=:pelinjohtaja where pelinro=:pelinro");
    $query->bindValue(':pelin_nimi',$pelin_nimi,PDO::PARAM_STR);
    $query->bindValue(':pelinjohtaja',$pelinjohtaja,PDO::PARAM_STR);
    $query->bindValue(':pelinro',$pelinro,PDO::PARAM_INT);

    $query->execute();

    header ('HTTP/1.1 200 OK');
    $data = array('pelin_nimi' => $pelin_nimi, 'pelinjohtaja' => $pelinjohtaja, 'pelinro' => $pelinro);
    echo json_encode($data);

} catch (PDOException $pdoex) {
    returnError($pdoex);
}