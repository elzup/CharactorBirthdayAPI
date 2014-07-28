<?php

require_once('./constants.php');
if (file_exists('./env_pro.php')) {
    require_once('./env_pro.php');
} else {
    define('ENVIRONMENT', ENVIRONMENT_DEVELOPMENT);
}

require_once './say_happy.php';
require_once './keys.php';
require_once './birthday_db_manager.php';

$dsn = DB_DSN;
$user = DB_USER;
$password = DB_PASS;

try {
    $bm = new BirthdayDBManager(new PDO($dsn, $user, $password));
    $sh = new SayHappy();
    var_dump($sh);
    exit;
    $chars = $sh->get_charactors();
//    var_dump($chars);
    $bm->regist_charactors($chars);
} catch (PDOException $e) {
    var_dump($e->getMessage());
}
