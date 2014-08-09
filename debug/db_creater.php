<?php

require_once '../class/birthday_db_manager.php';
require_once './say_happy.php';

$dsn = DB_DSN;
$user = DB_USER;
$password = DB_PASS;


try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->query("SET NAMES utf8");
    update_say_happy($dbh);
    add_my_titles($dbh);
    add_my_watchs($dbh);
} catch (PDOException $e) {
    var_dump($e->getMessage());
}

function update_say_happy(PDO $dbh) {
    $bm = new BirthdayDBManager($dbh);
    $sh = new SayHappy();
    $chars = $sh->get_charactors();
    $bm->regist_charactors($chars);
}

function add_my_titles(PDO $dbh) {
    $list = <<<EOF
日常
未来日記
ココロコネクト
俺の幼馴染と彼女が修羅場すぎる
さくら荘のペットな彼女
ぼくらの
涼宮ハルヒの憂鬱
俺の脳内選択肢が、学園ラブコメを全力で邪魔している
てーきゅう
未確認で進行形
Another
プラスチック姉さん
残響のテロル
とらドラ!
EOF;
    $titles = explode("\n", $list);
    $bm = new BirthdayDBManager($dbh);
    foreach ($titles as $title) {
        $bm->regist_title($title);
    }
}

function add_my_watchs(PDO $dbh) {
    $list = <<<EOF
それでも町は
物語シリーズ
僕は友達が少ない
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

