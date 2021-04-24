<?php
require_once './Inc/functions.php';
require_once './Inc/headers.php';

try {
    $db = openDb();
    $query = $db->prepare("SELECT * FROM peli");
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    echo header('HTTP/1.1 200 OK');
    echo json_encode($results);
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}