<?php


require_once dirname(__FILE__) . '/class/birthday_api_manager.php';
$get = $_GET;
mb_language("uni");
mb_internal_encoding("utf-8");
mb_http_input("auto");
mb_http_output("utf-8");

$obj = new stdclass();
if (empty($get) || empty($get['m1'])) {
    $obj = create_error_obj('invalid request url');
} else {
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
        $e = create_error_obj('sql error');
    }
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
