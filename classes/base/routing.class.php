<?php
class Routing {

	public static function execute() {
		$controllerName = 'main';

		$path = explode('?',$_SERVER['REQUEST_URI'])[0];
		$homepath = rtrim(parse_url(Config::HOME_URL,PHP_URL_PATH),'/');
		$path = trim(str_replace($homepath,'',$path), '/');
		$routes = explode('/', $path);

		$route_args = [];
		if (!empty($routes[0])) {
			$controllerName = $routes[0];
			if(isset($routes[1])) {
				unset($routes[0]);
				$route_args = array_values($routes);
			}
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
			  	Utils::Redirect($homepath.'/auth/');
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

	public static function home() {
		return rtrim(Config::HOME_URL,'/').'/';
	}
}