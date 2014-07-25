<?php
// vim: fenc=utf8:
class BirthdayDBManager {
    private $dbh;

    public function __construct(PDO $dbh) {
        $this->dbh = $dbh;
    }

    public function regist_charactors(array $charactors) {
        foreach ($charactors as $c) {
//            var_dump($c);
            $this->regist_charactor($c);
        }
    }

    public function regist_charactor($c) {
        $title_id = $this->regist_title($c->get_title());
        $charactor_id = $this->select_charactor_id($c->get_name());
        if ($charactor_id == -1) {
            $charactor_id = $this->insert_charactor($c, $title_id);
        }
        return $charactor_id;
    }

    public function regist_title($title_name) {
        $id = $this->select_title_id($title_name);
        if ($id == -1) {
            $id = $this->insert_title($title_name);
        }
        return $id;
    }

    private function insert_charactor($c, $title_id) {
        $stmt = $this->dbh->prepare('INSERT INTO ' . DB_TN_CHARACTORS . ' (charactor_name, birthday_m, birthday_d, title_id) VALUES (:NAME, :BM, :BD, :TITLEID)');
        $stmt->bindValue(':NAME', $c->get_name());
        $stmt->bindValue(':BM', $c->get_date_m());
        $stmt->bindValue(':BD', $c->get_date_d());
        $stmt->bindValue(':TITLEID', $title_id);
        $stmt->execute();
        return $this->select_charactor_id($c->get_name());
    }

    public function select_charactor_id($charactor_name) {
        $stmt = $this->dbh->prepare('SELECT charactor_id from ' . DB_TN_CHARACTORS . ' where charactor_name = :NAME');
        $stmt->bindValue(':NAME', $charactor_name);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row['charactor_id'];
        }
        return -1;
    }

    private function select_title_id($title_name) {
        $stmt = $this->dbh->prepare('SELECT title_id from ' . DB_TN_TITLES . ' where title_name = :NAME');
        $stmt->bindValue(':NAME', $title_name);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row['title_id'];
        }
        return -1;
    }

    private function insert_title($title_name) {
        $stmt = $this->dbh->prepare('INSERT INTO ' . DB_TN_TITLES . ' (title_name) VALUES (:NAME);');
        $stmt->bindValue(':NAME', $title_name);
        $stmt->execute();
        return $this->select_title_id($title_name);
    }

    public function regist_watch($user_id, $title_id) {
        try {
            $stmt = $this->dbh->prepare('INSERT INTO ' . DB_TN_WATCHS . ' (user_id, title_id) VALUES (:UID, :TID);');
            $stmt->bindValue(':UID', $user_id);
            $stmt->bindValue(':TID', $title_id);
            $stmt->execute();
        }
        catch (PDOException $e) {
        }
    }

    private function stmt_to_row($stmt) {
        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $rows[] = $row;
        }
        return $rows;
    }

    public function select_title($title_id = null) {
        $sql = 'SELECT * FROM ' . DB_TN_TITLES;
        if (!empty($title_id)) {
            $sql .= ' WHERE title_id = :ID';
        }
        $stmt = $this->dbh->prepare($sql);
        if (!empty($title_id)) {
            $stmt->bindValue(':ID', $title_id);
        }
        $stmt->execute();
        return $this->stmt_to_row($stmt);
    }

    public function select_title_search($q) {
        if (empty($q)) {
            return null;
        }
        $sql = 'SELECT * FROM ' . DB_TN_TITLES;
        $sql .= ' WHERE title_name LIKE :Q';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':Q', '%' . $q . '%');
        $stmt->execute();
        return $this->stmt_to_row($stmt);
    }

    public function select_charactor_search($q) {
        if (empty($q)) {
            return null;
        }
        $sql = 'SELECT * FROM ' . DB_TN_CHARACTORS . ',' . DB_TN_TITLES;
        $sql .= ' WHERE ' . DB_TN_CHARACTORS . '.title_id = ' . DB_TN_TITLES . '.title_id';
        $sql .= ' AND charactor_name LIKE :Q';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':Q', '%' . $q . '%');
        $stmt->execute();
        return $this->stmt_to_row($stmt);
    }

    public function select_charactor($charactor_id = null, $title_id = null) {
        $sql = 'SELECT * FROM ' . DB_TN_CHARACTORS . ',' . DB_TN_TITLES;
        $sql .= ' WHERE ' . DB_TN_CHARACTORS . '.title_id = ' . DB_TN_TITLES . '.title_id';
        if (!empty($charactor_id)) {
            $sql .= ' AND charactor_id = :CID';
        } else if (!empty($title_id)) {
            $sql .= ' AND ' . DB_TN_CHARACTORS . '.title_id = :TID';
        }
        $stmt = $this->dbh->prepare($sql);
        if (!empty($charactor_id)) {
            $stmt->bindValue(':CID', $charactor_id);
        } else if (!empty($title_id)) {
            $stmt->bindValue(':TID', $title_id);
        }
        $stmt->execute();
        return $this->stmt_to_row($stmt);
    }

    public function select_charactor_date($m, $d, $user_id = null)
    {
        $sql = 'SELECT * FROM ' . DB_TN_CHARACTORS . ',' . DB_TN_TITLES;
        $sql .= ' WHERE (' . DB_TN_CHARACTORS . '.title_id = ' . DB_TN_TITLES . '.title_id';
        $sql .= ' AND birthday_m = :M';
        if (!empty($d)) {
            $sql .= ' AND birthday_d = :D';
        }
        $sql .= ')';
        if (isset($user_id)) {
            $sql .= ' AND (' . DB_TN_CHARACTORS . '.title_id) IN (SELECT title_id FROM ' . DB_TN_WATCHS . ' WHERE user_id = :UID)';
        }
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':M', $m);
        if (!empty($d)) {
            $stmt->bindValue(':D', $d);
        }
        if (isset($user_id)) {
            $stmt->bindValue(':UID', $user_id);
        }
        $stmt->execute();
        return $this->stmt_to_row($stmt);
    }

    public function select_user($name)
    {
        $sql = 'SELECT * FROM ' . DB_TN_USERS . ' WHERE user_name = :NAME;';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':NAME', $name);
        $stmt->execute();
        return $this->stmt_to_row($stmt);
    }
}


