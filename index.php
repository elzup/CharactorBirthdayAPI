<?php
require_once './keys.php';
require_once './birthday_db_master.php';
$dsn = 'pgsql:dbname=' . DB_NAME .' host=' . DB_HOST . ' port=' . DB_PORT;
$user = DB_USER;
$password = DB_PASS;

$obj = new stdclass();
try {
    $bm = new BirthdayDBManager(new PDO($dsn, $user, $password));
    $obj->message = 'test';
    $obj->code = 120;
} catch (PDOException $e) {
    var_dump($e->getMessage());
    $obj->error = new stdclass();
    $obj->error->message = "api error";
}

header('Access-Control-Allow-Origin:*');
header('Content-type: application/json');

echo json_encode($obj);
