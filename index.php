<?php

require_once './birthday_db_master.php';
$get = $_GET;
var_dump($get);

$obj = new stdclass();
try {
//    $bm = ;
} catch (PDOException $e) {
    var_dump($e->getMessage());
    $obj->error = new stdclass();
    $obj->error->message = "api error";
}

header('Access-Control-Allow-Origin:*');
header('Content-type: application/json');

echo json_encode($obj);
