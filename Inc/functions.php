<?php
function openDb() {
    $servername = "localhost";
    $username = "harjoitustyoUser";
    $password = "tIPOgJc85ThmqgJb";
    $dbname = "roolipelit";

    $db = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $db;
}

function returnError(PDOException $pdoex) {
    echo header ('HTTP/1.1 500 Internal Server Error');
    $error = array('error' => $pdoex->getMessage());
    echo json_encode($error);
    exit;
}


