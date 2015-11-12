<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://devbana.tk/');
define('PATH', '../includes/');
define('LIBS', PATH . 'core/');


define('DB_TYPE', 'mysql');
define('DB_HOST', 'teambana.com');
define('DB_NAME', 'mvc');
define('DB_USER', 'ecommuser');
define('DB_PASS', '');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');