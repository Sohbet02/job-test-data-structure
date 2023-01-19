<?php
class Router
{
	private $routes;

	public function __construct()
	{
		$this->routes = array(
			'admin' => 'admin/index',
			'admin/login' => 'admin/login',
			'admin/logout' => 'admin/logout',
			'admin/data/add' => 'admin/dataAdd',
			'admin/data/edit' => 'admin/dataEdit',
			'admin/data/delete' => 'admin/dataDelete',
			'admin/data/get' => 'admin/dataGet',

			'' => 'Main/index',
			'(^.+$)' => 'Main/notFound'
		);
	}

	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		} else {
			return '';
		}
	}

	public function run()
	{
		$uri = $this->getURI();
		foreach ($this->routes as $uriPattern => $path) {
			if (preg_match("~^" . $uriPattern . "$~", $uri)) {
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				$segments = explode('/', $internalRoute);
				$controllerName = array_shift($segments) . 'Controller';
				$controllerName = ucfirst($controllerName);
				$actionName = 'action' . ucfirst(array_shift($segments));
				$parameters = $segments;
				$controllerFile = BASEURL . '/controllers/' . $controllerName . '.php';

				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}

				$controllerObject = new $controllerName;

				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);

				if ($result !== false) {
					break;
				}
			}
		}
	}
}
