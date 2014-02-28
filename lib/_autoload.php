<?php 

/**
 * autoload function that will be called, every time a class is missing
 * @param  string $className name of the class that needs to be included
 */
function autoload($className)
{
	if ( file_exists(LIBS_PATH . $className . '.php') ) {
		require LIBS_PATH . $className . '.php';
	} else {
		exit('The file ' . $className . '.php wasn\'t found in the libs folder');
	}
}

/**
 * Register our `autoload()` to be called for every missing class.
 */
spl_autoload_register('autoload');