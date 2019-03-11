<?php
/**
 * Router
 */
namespace Core\Router;

class Router
{
	private $routes = [];

	private $routeParams = [];

	public function add($route, $routeParams = [])
	{
		$route = preg_replace('/\//', '\\/', $route);

		$route = preg_replace('/\{([a-z]+)\}/', '(?P< \1 >[a-z-]+)', $route);

		$route = preg_replace('/\\s/', '', $route);

		$route = preg_replace('/\{([a-zA-Z]+):([^\}]+)\}/', '(?P< \1 >\2)', $route);

		$route = preg_replace('/\\s/', '', $route);

		$route = '/^' . $route . '$/i';

		$this->routes[$route] = $routeParams;
	}

	public function despatch($url)
	{
		$url = $this->removeQueryStringVariables($url);
		$hasMatchingRoute = $this->match($url);

		if ($hasMatchingRoute) {
			$controllerName = $this->convertToPascalCase($this->routeParams['controller']);
			$controllersDirectNameSpace = $controllerName;
			$controllerName = "App\Controllers\\{$controllersDirectNameSpace}\\{$controllerName}";
			$actionName = $this->convertToCamelCase($this->routeParams['action']);

			$this->callActionOnController($controllerName, $actionName);
		} else {
			throw new \Exception("url didnt match any route", 404);
		}
	}

	protected function removeQueryStringVariables($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }

        return $url;
    }

	private function match($url)
	{
		$routes = $this->routes;

		foreach ($routes as $currRegexRoutePattern => $routeParamsArr) {
			$hasUrlMatchingRoute = preg_match($currRegexRoutePattern, $url, $valuesFromUrl);
			
			if ($hasUrlMatchingRoute) {
				$this->putAllParamsOnThisRouteParams($routeParamsArr, $valuesFromUrl);
				return true;
			}
		}

		return false;
	}

	private function putAllParamsOnThisRouteParams(array $routeParamsArr = [], array $valuesFromUrl = [])
	{
		$this->routeParams = array_merge($this->routeParams, $routeParamsArr);

		foreach ($valuesFromUrl as $key => $value) {
			if (is_string($key)) {
				$this->routeParams[$key] = $value;
			}
		}
	}

	private function convertToPascalCase($string)
	{
		$pascalCaseStr = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
		return $pascalCaseStr;
	}

	private function convertToCamelCase($string)
	{
		$camelCaseStr = lcfirst($this->convertToPascalCase($string));
		return $camelCaseStr;
	}

	private function callActionOnController($controllerName, $actionName) 
	{
		if (class_exists($controllerName)) {
			$routeParams = $this->routeParams;
			$controller = new $controllerName($routeParams);
			/*to check wheather action is on the controller happens on the controller object*/
			call_user_func_array([$controller, $actionName], []);
		} else {
			throw new \Exception('no such controller', 404);
		}
	}

	public function getRoutes()
	{
		return $this->routes;
	}
}