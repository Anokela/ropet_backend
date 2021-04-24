<?php
require_once './Inc/functions.php';
require_once './Inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$hahmonro = filter_var($input->hahmonro,FILTER_SANITIZE_STRING);

try {
    $db = openDb();
    $query = $db->prepare("delete FROM tila WHERE hahmonro = :hahmonro");
    $query->bindValue(':hahmonro',$hahmonro,PDO::PARAM_INT);
    $query->execute();
    
    

    header ('HTTP/1.1 200 OK');
    $data = array('hahmonro' => $hahmonro);
    echo json_encode($data);

} catch (PDOException $pdoex) {
    returnError($pdoex);
}