<?php
/**
 * Autoloader.
 */

spl_autoload_register(
	function($className) {
		$classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
		$path =  "Library/{$classPath}.php";

		if (file_exists($path) === true) {
			require_once($path);
		}
	},
	true
);