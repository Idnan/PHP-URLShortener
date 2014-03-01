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

/** Shortening Errors */
define('ERROR_NO_URL', 'Error! No URL was provided to be shortened!');
define('ERROR_INVALID_URL', 'Error! Invalid URL entered, please enter a valid URL e.g. http://somelink.com/foo/bar');
define('ERROR_IS_SHORTENED', 'Error! URL you have provided is already shortened!');
define('ERROR_UNKNOWN', 'An unknown error occured, and the shortening was unsuccessful, please try again!');
define('SHORTENED_SUCCESS', 'URL successfuly shortened!');


/** Finding this in the URL would mean, the URL is already shortened! */
define('URL_CHUNK', '127.0.0.1');