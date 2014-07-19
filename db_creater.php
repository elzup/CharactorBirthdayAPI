<?php

require_once './say_happy.php';
require_once './keys.php';

$dsn = 'pgsql:dbname=' . DB_NAME .' host=' . DB_HOST . ' port=' . DB_PORT;
$user = DB_USER;
$password = DB_PASS;

try {
    $bm = new BirthdayDBManager(new PDO($dsn, $user, $password));
    $id = $bm->regist_title("fire");
    echo $id;
} catch (PDOException $e) {
    var_dump($e->getMessage());
}

class BirthdayDBManager {
    private $dbh;

    public function __construct(PDO $dbh) {
        $this->dbh = $dbh;
    }

    public function regist_charactors(array $charactors) {
        foreach ($charactors as $c) {
            $this->regist_charactor($c);
        }
    }

    public function regist_charactor($c) {
        $title_id = $this->regist_tilte($c->get_title());
        if ($charactor_id = $this->select_charactor_id($c->get_name())) {
            return $charactor_id;
        }
        return $this->insert_charactor($c, $title_id);
    }

    public function regist_title($title_name) {
        $id = $this->select_title_id($title_name);
        if ($id == -1) {
            $id = $this->insert_title($title_name);
        }
        return $id;
    }

    private function insert_charactor($c, $title_id) {
        $stmt = $this->dbh->prepare('INSERT INTO charactor (charactor_name, birthday_m, birthday_d) VALUES (:NAME, :BM, :BD)');
        $stmt->bindValue(':NAME', $c->get_name());
        $stmt->bindValue(':BM', $c->get_date_m());
        $stmt->bindValue(':BD', $c->get_date_d());
        $stmt->execute();
        return $this->select_charactor_id($c->get_name());
    }

    public function select_charactor_id($charactor_name) {
        $stmt = $this->dbh->prepare('SELECT charactor_id from charactor where charactor_name = :NAME');
        $stmt->bindValue(':NAME', $charactor_name);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row['charactor_id'];
        }
        return -1;
    }

    private function select_title_id($title_name) {
        $stmt = $this->dbh->prepare('SELECT title_id from title where title_name = :NAME');
        $stmt->bindValue(':NAME', $title_name);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row['title_id'];
        }
        return -1;
    }

    private function insert_title($title_name) {
        try {
            $stmt = $this->dbh->prepare("INSERT INTO title (title_name) VALUES (:NAME);");
            $stmt->bindValue(':NAME', $title_name);
            $stmt->execute();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
        return $this->select_title_id($title_name);
    }
    
}

