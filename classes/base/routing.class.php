<?php
class Routing {
	public static function execute() {
		$controllerName = 'main';
		$path = trim($_SERVER['REQUEST_URI'], '/');
    if (($position = strpos($path, '?')) !== FALSE) {
    	$path = substr($path, 0, $position);
    }
		$routes = explode('/', $path);

		$route_args = [];
		if (!empty($routes[0])) {
			$controllerName = $routes[0];
			unset($routes[0]);
			if(!empty($routes))
				$route_args = array_values($routes);
		}

		$controllerName = strtolower($controllerName).'Controller';

		$fileWithController = $controllerName.'.php';
		$fileWithControllerPath = ABSPATH."/resources/controllers/" . $fileWithController;
		if(file_exists($fileWithControllerPath)) {
			include $fileWithControllerPath;
			$controller = new $controllerName;

			/* Auth */
			if($controller->onlyauth == true) {
			  if(Auth::isLogged() === false) {
			  	Utils::Redirect('/auth/');
			  }
			}
			/* Auth */

			$controller->init($route_args);
		} else {
			include ABSPATH."/resources/controllers/error404Controller.php";
			$controller = new error404Controller();
			$controller->init();
		}
	}
}