<?php

$url_top = 'http://localhost/birthday/';

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

echo PHP_EOL;
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

/*
 * charactors/search キャラ名検索
 */
$parameter = array(
    'q' => 'ひたぎ',
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
var_dump($res);

