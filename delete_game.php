<?php
require_once './Inc/functions.php';
require_once './Inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$pelinro = filter_var($input->pelinro,FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $query = $db->prepare("delete FROM peli WHERE pelinro = :pelinro");
    $query->bindValue(':pelinro',$pelinro,PDO::PARAM_INT);

    $query->execute();

    header ('HTTP/1.1 200 OK');
    $data = array('pelinro' => $pelinro);
    echo json_encode($data);

} catch (PDOException $pdoex) {
    returnError($pdoex);
}
