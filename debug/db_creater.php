<?php

require_once '../class/birthday_db_manager.php';

$dsn = DB_DSN;
$user = DB_USER;
$password = DB_PASS;


try {
    $dbh = new PDO($dsn, $user, $password);
//    update_say_happy($dbh);
    add_my_anime($dbh);
} catch (PDOException $e) {
    var_dump($e->getMessage());
}

function update_say_happy(PDO $dbh) {
    $bm = new BirthdayDBManager($dbh);
    $sh = new SayHappy();
    var_dump($sh);
    exit;
    $chars = $sh->get_charactors();
    //    var_dump($chars);
    $bm->regist_charactors($chars);
}


function add_my_anime(PDO $dbh) {
    $list = <<<EOF
それでも町は
物語シリーズ
僕は友達が少ない
ヨスガ
ゆるゆり
俺の妹が
中二病でも
ソードアート
とある
ジョジョ
琴浦さん
たまこま
SHUFFLE
School Days
やはり俺の
進撃の巨人
ダンガンロンパ
恋愛ラボ
ニセコイ
妹のようすが
桜Trick
生徒会役員共
ディーふらぐ
コードギアス
ラブライブ
ニセコイ
ご注文は
劣等生
アクセル・ワールド
東京喰種
EOF;
    $list = preg_split("#\n#", $list);
    $bm = new BirthdayDBManager($dbh);
    $user_id = 1;
    foreach($list as $name) {
        echo "[$name]";
        $rows = $bm->select_title_search($name);
        if (!empty($rows)) {
            echo '*';
            foreach($rows as $row) {
                $title_id = $row['title_id'];
                if ($title_id == 5302) {
                    continue;
                }
                $bm->regist_watch($user_id, $title_id);
            }
        } else {
            echo str_repeat('!', 50) . "\n";
        }
    }
}
