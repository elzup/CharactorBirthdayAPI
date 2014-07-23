<?php

$url_top = 'http://localhost/birthday/';

/*
 * titles/search 作品名検索
 */
$url_main = 'titles/search';
$parameter = array(
    'q' => 'ゆるゆり',
    'include_details' => true,
);
$url_tail = '?' . http_build_query($parameter);
$url = $url_top . $url_main . $url_tail;

$json = file_get_contents($url);
$res = json_decode($json);
$title = $res[0];

// printout charactor names
if (isset($title->charactors)) {
    foreach($title->charactors as $c) {
        echo "{$c->name}({$c->day_m}月{$c->day_d}日)" . PHP_EOL;
    }
}

