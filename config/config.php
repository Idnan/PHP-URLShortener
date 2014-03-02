<?php 

/** Turn on error reporting */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/** Base URL for the website */
define('URL', 'http://127.0.0.1/linkoo/');

/** Common Paths */
define('CSS', 'assets/css/');
define('FONT', 'assets/fonts/');
define('JS', 'assets/js/');
define('IMG', 'assets/images/');

define('LIBS_PATH', 'lib/');


/** Database information */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'linkoo');
define('DB_USER', 'root');
define('DB_PASS', '');

/** Finding this in the URL would mean, the URL is already shortened! */
define('URL_CHUNK', '127.0.0.1');