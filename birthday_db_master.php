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
}

