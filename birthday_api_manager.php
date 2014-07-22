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
        echo 'asdlkfjalsdkfj';
        $this->installDBManager();
    }

    private function installDBManager() {
        $dsn = 'pgsql:dbname=' . DB_NAME .' host=' . DB_HOST . ' port=' . DB_PORT;
        $user = DB_USER;
        $password = DB_PASS;
        $this->dbm = new BirthdayDBManager(new PDO($dsn, $user, $password));
    }

    public function titles($param) {
        $title_id = $param[PARAM_NAME_TITLE_ID];
        $is_detail = @$param[PARAM_NAME_INCLUDE_DETAILS] == 'true';

        $rows = $this->dbm->select_title($title_id);
        $titles = $this->create_titles($rows);
        if ($is_detail) {

        }
    }

    public function titles_search($param) {
    }

    public function charactors() {
    }

    private function create_charactors($rows, $is_detail = false) {
        $charactors = array();
        foreach($rows as $i => $row) {
            $charactors[] = create_charactor($row, $is_detail);
        }
        return $charactors;
    }

    private function create_charactor($row, $is_detailtitle = false) {
        $obj = new stdclass();
        $obj->id = $row['id'];
        $obj->name = $row['name'];
        $obj->day_m = $row['day_m'];
        $obj->day_d = $row['day_d'];
        if (empty($title)) {
            $obj->title = new stdclass();
            $obj->title->id = $row['tilte_id'];
            $obj->title->name = $row['tilte_name'];
        }
    }

    private function create_titles($rows, $is_detail = false) {
        $titles = array();
        foreach($rows as $i => $row) {
            $charactors = $this->create_charactors($this->dbm->select_charactor($row['title_id']));
            $titles[] = create_charactor($row, $charactors);
        }
        return $titles;
    }

    private function create_title($row) {
        $obj = new stdclass();
        $obj->id = $row['title_id'];
        $obj->name = $row['title_name'];
        if (empty($charactors)) {
            $obj->charactors = $charactors;
        }
        return $obj;
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
