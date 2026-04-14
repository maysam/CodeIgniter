<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = getenv('DB_HOST') ? getenv('DB_HOST') : 'mysql';
$db['default']['username'] = getenv('DB_USER') ? getenv('DB_USER') : 'ci_user';
$db['default']['password'] = getenv('DB_PASSWORD') ? getenv('DB_PASSWORD') : 'ci_password';
$db['default']['database'] = getenv('DB_NAME') ? getenv('DB_NAME') : 'ci_weblog';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;
