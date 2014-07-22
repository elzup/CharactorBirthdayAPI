<?php

require_once './keys.php';
require_once './constants.php';
require_once('./birthday_db_manager.php');

class BirthdayAPIManager {
    /**
     * @var BirthdayDBManager
     */
    private $dbm;

    public function __construct() {
        installDBManager();
    }

    public function installDBManager() {
        $dsn = 'pgsql:dbname=' . DB_NAME .' host=' . DB_HOST . ' port=' . DB_PORT;
        $user = DB_USER;
        $password = DB_PASS;
        $this->dbm = new BirthdayDBManager(new PDO($dsn, $user, $password));
    }

    public function titles($param) {
//| title\_id       | 任意  | 作品IDの指定 |
//| include\_detil  | 任意  | 詳細あり(bool) default: false |
//| user\_id        | 任意  | ユーザIDの指定 |
        return $api;
    }

    public function charactors() {
    }

    public function __call($m, $b)
    {
        echo 'nothing method called';
        echo 'm';
        var_dump($m);
        echo 'b';
        var_dump($b);
    }
}
