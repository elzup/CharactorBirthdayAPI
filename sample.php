<?php

//$url_top = 'http://localhost/birthday/';
$url_top = 'http://api.elzup.com/';

/*
 * titles/search 作品名検索
 */
$parameter = array(
    'q' => 'ゆるゆり',
    'include_details' => true,
);
$url_main = 'titles/search';
$url_tail = '?' . http_build_query($parameter);
$url = $url_top . $url_main . $url_tail;

echo '------ titles/search ------' . PHP_EOL;
echo 'url : ' . $url . PHP_EOL;
$json = file_get_contents($url);
echo 'json: ' . $json . PHP_EOL;
$res = json_decode($json);
$title = $res[0];

echo '[' . $title->name . ']のキャラクター一覧' . PHP_EOL;
if (isset($title->charactors)) {
    foreach($res[0]->charactors as $c) {
        echo "{$c->name}({$c->day_m}月{$c->day_d}日)" . PHP_EOL;
    }
}
echo PHP_EOL;

/*
 * charactors/search キャラ名検索
 */
$q = '京子';
$parameter = array(
    'q' => $q,
    'include_details' => true,
);
$url_main = 'charactors/search';
$url_tail = '?' . http_build_query($parameter);
$url = $url_top . $url_main . $url_tail;

echo '------ charactors/search ------' . PHP_EOL;
echo 'url : ' . $url . PHP_EOL;
$json = file_get_contents($url);
echo 'json: ' . $json . PHP_EOL;
$res = json_decode($json);
echo '[' . $q . ']検索結果キャラクター一覧' . PHP_EOL;
if (isset($res)) {
    foreach($res as $c) {
        echo sprintf('%s(%2d月%2d日)<%s>', $c->name, $c->day_m, $c->day_d, $c->title->name) . PHP_EOL;
    }
}
echo PHP_EOL;

/*
 * charactors/date 日付検索(日付指定)
 */
$m = 7;
$d = 26;
$parameter = array(
    'date_m' => $m,
    'date_d' => $d,
    'include_details' => true,
);
$url_main = 'charactors/date';
$url_tail = '?' . http_build_query($parameter);
$url = $url_top . $url_main . $url_tail;

echo '------ charactors/date ------' . PHP_EOL;
echo 'url : ' . $url . PHP_EOL;
$json = file_get_contents($url);
echo 'json: ' . $json . PHP_EOL;
$res = json_decode($json);
echo $m . '月' . $d . '日が誕生日結果キャラクター一覧' . PHP_EOL;
if (isset($res)) {
    foreach($res as $c) {
        echo sprintf('%s(%2d月%2d日)<%s>', $c->name, $c->day_m, $c->day_d, $c->title->name) . PHP_EOL;
    }
}
echo PHP_EOL;

/*
 * charactors/date 日付検索(月指定,ユーザwatched)
 */
$m = 6;
$user_name = 'elzup';
$parameter = array(
    'date_m' => $m,
    'user_name' => $user_name,
    'include_details' => true,
);
$url_main = 'charactors/date';
$url_tail = '?' . http_build_query($parameter);
$url = $url_top . $url_main . $url_tail;

echo '------ charactors/date ------' . PHP_EOL;
echo 'url : ' . $url . PHP_EOL;
$json = file_get_contents($url);
echo 'json: ' . $json . PHP_EOL;
$res = json_decode($json);
echo $m . '月が誕生日で' . $user_name . 'がwatchした結果キャラクター一覧' . PHP_EOL;
if (isset($res)) {
    foreach($res as $c) {
        echo sprintf('%s(%2d月%2d日)<%s>', $c->name, $c->day_m, $c->day_d, $c->title->name) . PHP_EOL;
    }
}
echo PHP_EOL;


/*
 * charactors/tody 今日検索
 */
$parameter = array(
    'include_details' => true,
);
$url_main = 'charactors/today';
$url_tail = '?' . http_build_query($parameter);
$url = $url_top . $url_main . $url_tail;

echo '------ charactors/today ------' . PHP_EOL;
echo 'url : ' . $url . PHP_EOL;
$json = file_get_contents($url);
echo 'json: ' . $json . PHP_EOL;
$res = json_decode($json);
echo '今日が誕生日結果キャラクター一覧' . PHP_EOL;
if (isset($res)) {
    foreach($res as $c) {
        echo sprintf('%s(%2d月%2d日)<%s>', $c->name, $c->day_m, $c->day_d, $c->title->name) . PHP_EOL;
    }
}
echo PHP_EOL;

