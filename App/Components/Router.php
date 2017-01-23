<?php
namespace App\Components;
/**
 * Class Router
 * Component to operate the routes
 */
class Router {

	/**
	 * Property to hold an array of routes
	 * @var array
	 */
	private $routes;

	/**
	 * Constructor
	 */
	public function __construct() {

		$routesPath = ROOT . '/App/Config/routes.php';

		$this -> routes =
		include ($routesPath);
	}

	/**
	 * Returns the query string
	 */
	private function getURI() {
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	/**
	 * Method to handle the request
	 */
	public function run() {

		$uri = $this -> getURI();

		// Check the availability of this request in the array of routes (routes.php)
		foreach ($this->routes as $uriPattern => $path) {

			// Compare $uriPattern and $uri
			if (preg_match("~$uriPattern~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);


                $segments = explode('/', $internalRoute);

				$controllerName = array_shift($segments) . 'Controller';
				$controllerName = ucfirst($controllerName);
                $controllerName = '\App\Controllers\\'.$controllerName;
				$actionName = 'action' . ucfirst(array_shift($segments));

				$parameters = $segments;

                //$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

				//if (file_exists($controllerFile)) {
				//	include_once ($controllerFile);
				//}

                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

				// If the controller method is called successfully, shutdown the router
				if ($result != null) {
					break;
				}
			}
		}
	}

}

