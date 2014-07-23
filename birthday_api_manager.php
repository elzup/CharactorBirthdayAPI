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
        $this->installDBManager();
    }

    private function installDBManager() {
        $dsn = 'pgsql:dbname=' . DB_NAME .' host=' . DB_HOST . ' port=' . DB_PORT;
        $user = DB_USER;
        $password = DB_PASS;
        $this->dbm = new BirthdayDBManager(new PDO($dsn, $user, $password));
    }

    /* 
     * API calling methods
     * ---------------------------- */
    public function titles($param) {
        $title_id = $param[PARAM_NAME_TITLE_ID];
        $is_detail = @$param[PARAM_NAME_INCLUDE_DETAILS];

        $rows = $this->dbm->select_title($title_id);
        $titles = $this->create_titles($rows, $is_detail);
        return $titles;
    }

    public function titles_search($param) {
        $q = $param[PARAM_NAME_Q];
        $is_detail = @$param[PARAM_NAME_INCLUDE_DETAILS];

        $rows = $this->dbm->select_title_search($q);
        $titles = $this->create_titles($rows, $is_detail);
        return $titles;
    }

    public function charactors($param) {
        $charactor_id = $param[PARAM_NAME_CHARACTOR_ID];
        $is_detail = @$param[PARAM_NAME_INCLUDE_DETAILS];

        $rows = $this->dbm->select_charactor($charactor_id);
        $charactors = $this->create_charactors($rows, $is_detail);
        return $charactors;
    }

    public function charactors_search($param) {
        $q = $param[PARAM_NAME_Q];
        $is_detail = @$param[PARAM_NAME_INCLUDE_DETAILS];

        $rows = $this->dbm->select_charactor_search($q);
        $charactors = $this->create_charactors($rows, $is_detail);
        return $charactors;
    }

    /*
     * create obj methods
     * -------------------------------- */

    private function create_charactors($rows, $is_detail = false) {
        $charactors = array();
        foreach($rows as $i => $row) {
            $charactors[] = $this->create_charactor($row, $is_detail);
        }
        return $charactors;
    }

    private function create_charactor($row, $is_detail= false) {
        $obj = new stdclass();
        $obj->id = $row['charactor_id'];
        $obj->name = $row['charactor_name'];
        $obj->day_m = $row['birthday_m'];
        $obj->day_d = $row['birthday_d'];
        if ($is_detail) {
            $obj->title = new stdclass();
            $obj->title->id = $row['tilte_id'];
            $obj->title->name = $row['tilte_name'];
        }
        return $obj;
    }

    private function create_titles($rows, $is_detail = false) {
        $titles = array();
        if (empty($rows)) {
            return null;
        }
        foreach($rows as $i => $row) {
            $charactors = null;
            if ($is_detail) {
                $rowsc = $this->dbm->select_charactor(null, $row['title_id']);
                $charactors = $this->create_charactors($rowsc);
            }
            $titles[] = $this->create_title($row, $charactors);
        }
        return $titles;
    }

    private function create_title($row, $charactors) {
        $obj = new stdclass();
        $obj->id = $row['title_id'];
        $obj->name = $row['title_name'];
        if (!empty($charactors)) {
            $obj->charactors = $charactors;
        }
        return $obj;
    }

    public function __call($m, $b)
    {
        return create_error_obj('no find \'' . $m . '\' API');
    }
}
