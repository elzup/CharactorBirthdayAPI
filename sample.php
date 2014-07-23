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

$json = file_get_contents($url);
$res = json_decode($json);
$tilte = $res[0];

if (isset($tilte->charactors)) {
    foreach($res[0]->charactors as $c) {
        echo "{$c->name}({$c->day_m}月{$c->day_d}日)" . PHP_EOL;
    }
}
exit;

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

$json = file_get_contents($url);
$res = json_decode($json);

