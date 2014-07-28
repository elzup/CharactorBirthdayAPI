<?php

require_once './keys.php';
require_once './constants.php';
require_once('./birthday_db_manager.php');

class BirthdayAPIManager {
    /**
     * @var BirthdayDBManager
     */
    private $dbm;

    public function __construct($pdo = null) {
        if (empty($pdo)) {
            $this->installDBManager();
        } else {
            $this->dbm = $pdo;
        }
    }

    private function installDBManager() {
        $dsn = DB_DSN;
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

    public function charactors_date($param)
    {
        $m = $param[PARAM_NAME_DATE_M];
        $d = @$param[PARAM_NAME_DATE_D];
        $user_id = @$param[PARAM_NAME_USER_ID];
        $user_name = @$param[PARAM_NAME_USER_NAME];
        $is_detail = @$param[PARAM_NAME_INCLUDE_DETAILS];

        if (empty($user_id) && $user_name) {
            $rows = $this->dbm->select_user($user_name);
            $user_id = @$rows[0]['user_id'];
        }

        $rows = $this->dbm->select_charactor_date($m, $d, $user_id);
        $charactors = $this->create_charactors($rows, $is_detail);
        return $charactors;
    }

    public function charactors_user($param)
    {
        $user_id = $param[PARAM_NAME_USER_ID];
        $user_name = @$param[PARAM_NAME_USER_NAME];
        $is_detail = @$param[PARAM_NAME_INCLUDE_DETAILS];

        if (empty($user_id)) {
            $rows = $this->dbm->select_user($user_name);
            $user_id = @$rows[0]['user_id'];
        }

        $rows = $this->dbm->select_charactor_user($m, $d);
        $charactors = $this->create_charactors($rows, $is_detail);
        return $charactors;
    }


    public function charactors_today($param)
    {
        $plus = @$param[PARAM_NAME_DATE_PLUS] ?: 0;
        $daytime = strtotime("+{$plus} day");
        $param[PARAM_NAME_DATE_M] = date('n', $daytime);
        $param[PARAM_NAME_DATE_D] = date('j', $daytime);
        return $this->charactors_date($param);
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
            $obj->title->id = $row['title_id'];
            $obj->title->name = $row['title_name'];
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
