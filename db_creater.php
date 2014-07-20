<?php

require_once './say_happy.php';
require_once './keys.php';
require_once './dbconstants.php';
require_once './birthday_db_master.php';

$dsn = 'pgsql:dbname=' . DB_NAME .' host=' . DB_HOST . ' port=' . DB_PORT;
$user = DB_USER;
$password = DB_PASS;

try {
    $bm = new BirthdayDBManager(new PDO($dsn, $user, $password));
    $sh = new SayHappy();
    $chars = $sh->get_charactors();
//    var_dump($chars);
    $bm->regist_charactors($chars);
} catch (PDOException $e) {
    var_dump($e->getMessage());
}
