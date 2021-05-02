<?php
require_once './Inc/functions.php';
require_once './Inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$hahmonro = filter_var($input->hahmonro,FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $query1 = $db->prepare("delete FROM tila WHERE hahmonro = :hahmonro");
    $query2 = $db->prepare("delete FROM hahmo WHERE hahmonro = :hahmonro");
    $query1->bindValue(':hahmonro',$hahmonro,PDO::PARAM_INT);
    $query2->bindValue(':hahmonro',$hahmonro,PDO::PARAM_INT);
    
    $query1->execute();
    $query2->execute();
    
    header ('HTTP/1.1 200 OK');
    $data = array('hahmonro' => $hahmonro);
    echo json_encode($data);

} catch (PDOException $pdoex) {
    returnError($pdoex);
}