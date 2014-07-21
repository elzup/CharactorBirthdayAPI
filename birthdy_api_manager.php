<?php

require_once './keys.php';
require_once './dbconstants.php';
require_once('./birthday_db_master.php');

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
