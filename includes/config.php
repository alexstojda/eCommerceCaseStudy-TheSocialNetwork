<?php

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://devbana.tk/');
define('PATH', '../includes/');
define('LIBS', PATH . 'core/');


define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'banacommercestudy_ecom');
define('DB_USER', 'ecommuser');
define('DB_PASS', 'ybu4a3agy');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'IfYouNeedOtherHashes');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'Hello...IsItMeYoureLookingFor!!___TeamB4N4');