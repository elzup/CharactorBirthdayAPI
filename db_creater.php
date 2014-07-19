<?php

require_once './say_happy.php';
require_once './keys.php';

$dsn = 'pgsql:dbname=' . DB_NAME .' host=' . DB_HOST . ' port=' . DB_PORT;
$user = DB_USER;
$password = DB_PASSWORD;

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

    public function insert_charactors($charactors) {
    }

    public function insert_charactor($c, $title_id) {
        $stmt = $this->dbh->prepare('INSERT INTO charactor (charactor_id, charactor_name, birthday_m, birthday_d) VALUES (:ID, :NAME, :BM, :BD)');
        $stmt->bindValue(':ID', $c->get_id());
        $stmt->bindValue(':NAME', $c->get_name());
        $stmt->bindValue(':BM', $c->get_date_m());
        $stmt->bindValue(':BD', $c->get_date_d());
        $stmt->execute();
    }

    public function regist_title($title_name) {
        $id = $this->select_title_id($title_name);
        if ($id == -1) {
            $id = $this->insert_title($title_name);
        }
        return $id;
    }

    public function select_title_id($title_name) {
        $stmt = $this->dbh->prepare('SELECT title_id from title where title_name = :NAME');
        $stmt->bindValue(':NAME', $title_name);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row['title_id'];
        }
        return -1;
    }

    public function insert_title($title_name) {
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

