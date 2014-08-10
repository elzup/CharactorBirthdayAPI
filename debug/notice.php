<?php

require_once('../config/constants.php');

// keyが間違っていた場合
if (@$_GET['key'] != NOTICE_KEY && ENVIRONMENT == ENVIRONMENT_PRODUCTION) {
    exit;
}

$user_name = 'elzup';
$parameter = array(
    'user_name' => $user_name,
    'include_details' => true,
);
$url_tail = '?' . http_build_query($parameter);
$url = 'http://api.elzup.com/birthday/charactors/today.json' . $url_tail;
$chara_list = json_decode(file_get_contents($url));
// 該当キャラ無し
if (empty($chara_list)) {
    exit;
}

// text構築
$text = date("本日m月d日が誕生日のキャラ\n");
foreach ($chara_list as $c) {
    $text .= "{$c->name} [{$c->title->name}]\n";
}

require_once('../lib/twitteroauth.php');

$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_KEY, TWITTER_OAUTH_TOKEN, TWITTER_OAUTH_TOKEN_SECRET);
//var_dump($connection);
$url = 'https://api.twitter.com/1.1/direct_messages/new.json';
$param = [
    'user_id' => '1106631758',
    'text' => $text,
];
$res = $connection->get($url, $param);
var_dump($res);
