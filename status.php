<?php
require_once './Inc/functions.php';
require_once './Inc/headers.php';

try {
    $hahmonro = filter_input(INPUT_GET, 'hahmonro', FILTER_SANITIZE_STRING);

    $db = openDb();
    $query = $db->prepare("SELECT * FROM tila WHERE hahmonro = :hahmonro");
    $query->bindValue(':hahmonro',$hahmonro,PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    echo header('HTTP/1.1 200 OK');
    echo json_encode($results);
}

catch (PDOException $pdoex) {
    returnError($pdoex);
}