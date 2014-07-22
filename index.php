<?php

require_once './birthday_api_manager.php';
$get = $_GET;
var_dump($get);

$obj = new stdclass();
if (empty($get) || $get['m1'])
try {
//    $bm = ;
} catch (PDOException $e) {
    // TODO: remove on production
    var_dump($e->getMessage());
}

header('Access-Control-Allow-Origin:*');
header('Content-type: application/json');

echo json_encode($obj);

function create_error_obj($message) {
    $obj = new stdclass();
    $obj->error = new stdclass();
    $obj->error->message = $message;
    return $obj;
}
