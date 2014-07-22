<?php

require_once './birthday_api_manager.php';
$get = $_GET;
var_dump($get);

$obj = new stdclass();
if (empty($get) || empty($get['m1'])) {
    $obj = create_error_obj('invalid request url');
}
else {
    $bm = new BirthdayAPIManager();
    try {
        if (empty($get['m2'])) {
            $obj = $bm->{$get['m1']}($get);
        } else {
            $obj = $bm->{$get['m1'] . '_' . $get['m2']}($get);
        }
        //    $bm = ;
    } catch (PDOException $e) {
        // TODO: remove on production
        var_dump($e->getMessage());
    }
}

header('Access-Control-Allow-Origin:*');
header('Content-type: application/json');

var_dump($obj);
echo json_encode($obj);

function create_error_obj($message) {
    $obj = new stdclass();
    $obj->error = new stdclass();
    $obj->error->message = $message;
    return $obj;
}
