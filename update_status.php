<?php
require_once './inc/functions.php';
require_once './inc/headers.php';

$input = json_decode(file_get_contents('php://input'));
$luontipvm = filter_var($input->luontipvm,FILTER_SANITIZE_STRING);
$kuolinpvm = filter_var($input->kuolinpvm,FILTER_SANITIZE_STRING);
$hahmonro = filter_var($input->hahmonro,FILTER_SANITIZE_STRING);
$tila = filter_var($input->tila,FILTER_SANITIZE_STRING);

try {

    if ($tila !== 'Elossa') {
        $db = openDb();
        $query = $db->prepare("UPDATE tila SET luontipvm=:luontipvm,kuolinpvm=:kuolinpvm, tila=:tila where hahmonro=:hahmonro");
        $query->bindValue(':luontipvm',$luontipvm,PDO::PARAM_STR);
        $query->bindValue(':kuolinpvm',$kuolinpvm,PDO::PARAM_STR);
        $query->bindValue(':tila',$tila,PDO::PARAM_STR);
        $query->bindValue(':hahmonro',$hahmonro,PDO::PARAM_INT);
    
        $query->execute();
    
        header ('HTTP/1.1 200 OK');
        $data = array('luontipvm' => $luontipvm, 'kuolinpvm' => $kuolinpvm,'tila' => $tila , 'hahmonro' => $hahmonro);
        echo json_encode($data);
    } else {
        $db = openDb();
    $query = $db->prepare("UPDATE tila SET luontipvm=:luontipvm, tila=:tila where hahmonro=:hahmonro");
    $query->bindValue(':luontipvm',$luontipvm,PDO::PARAM_STR);
    $query->bindValue(':tila',$tila,PDO::PARAM_STR);
    $query->bindValue(':hahmonro',$hahmonro,PDO::PARAM_INT);

    $query->execute();

    header ('HTTP/1.1 200 OK');
    $data = array('luontipvm' => $luontipvm, 'tila' => $tila , 'hahmonro' => $hahmonro);
    echo json_encode($data);
    }

    

} catch (PDOException $pdoex) {
    returnError($pdoex);
}