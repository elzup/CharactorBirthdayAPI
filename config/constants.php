<?php

define('ENVIRONMENT_DEVELOPMENT', 'dev');
define('ENVIRONMENT_PRODUCTION', 'pro');
if (file_exists(dirname(__FILE__).'/env_pro.php')) {
    define('ENVIRONMENT', ENVIRONMENT_PRODUCTION);
} else {
    define('ENVIRONMENT', ENVIRONMENT_DEVELOPMENT);
}

if (ENVIRONMENT == ENVIRONMENT_DEVELOPMENT) {
    define('DB_TN_PREFIX', 'ba_');
} else {
    define('DB_TN_PREFIX', 'ba_');
}
define('DB_TN_TITLES', DB_TN_PREFIX . 'titles');
define('DB_TN_CHARACTORS', DB_TN_PREFIX . 'charactors');
define('DB_TN_USERS', DB_TN_PREFIX . 'users');
define('DB_TN_WATCHS', DB_TN_PREFIX . 'watchs');

define('PARAM_NAME_METHOD1', 'm1');
define('PARAM_NAME_METHOD2', 'm2');

define('PARAM_NAME_TITLE_ID', 'title_id');
define('PARAM_NAME_CHARACTOR_ID', 'charactor_id');
define('PARAM_NAME_USER_ID', 'user_id');
define('PARAM_NAME_USER_NAME', 'user_name');
define('PARAM_NAME_INCLUDE_DETAILS', 'include_details');
define('PARAM_NAME_Q', 'q');
define('PARAM_NAME_DATE_M', 'date_m');
define('PARAM_NAME_DATE_PLUS', 'plus');
define('PARAM_NAME_DATE_D', 'date_d');

require_once dirname(__FILE__).'/keys.php';

