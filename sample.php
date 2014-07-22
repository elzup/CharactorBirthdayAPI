<?php

$url_top = 'http://localhost/birthday/';

$parameter = array(
    'q' => '物語',
    'include_details' => 'true',
);
$url_main = 'titles/search';
$url_tail = '?' . http_build_query($parameter);
$url = $url_top . $url_main . $url_tail;

$json = file_get_contents($url);
var_dump(json_decode($json));

