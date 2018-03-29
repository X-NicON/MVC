<?php
	define('ABSPATH', dirname(__FILE__).'/');

	require ABSPATH.'/config.php';

	if(Config::DEBUG) {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}

	setlocale(LC_ALL, 'ru_RU.utf8');
	spl_autoload_register('autoload_class');

	function autoload_class($className) {
		$className     = strtolower($className);
		$fileClass     = ABSPATH.'/classes/'.$className.'.class.php';
		$fileBaseClass = ABSPATH.'/classes/base/'.$className.'.class.php';

		if(file_exists($fileClass)) {
			include $fileClass;
		}elseif(file_exists($fileBaseClass)) {
			include $fileBaseClass;
		}
	}

  Routing::execute();