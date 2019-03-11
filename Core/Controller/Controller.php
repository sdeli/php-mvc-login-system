<?php

namespace Core\Controller;
use Core\View\View as View;
use Core\Controller\Auth\Auth as Auth;
use App\Model\User\User as User;
use App\Model\RememberLogin\RememberLogin as RememberLogin;

abstract class Controller extends Auth 
{
	public $routeParams = [];

	function __construct(array $routeParams = [])
	{
		$this->routeParams = $routeParams;
		parent::__construct(User::class, RememberLogin::class);
	}

    public function __call($actionName, array $args = [])
    {
        $doesActionExistOnCurrObj = method_exists($this, $actionName);

        if ($doesActionExistOnCurrObj) {
			$this->before();
			call_user_func_array([$this, $actionName], $args);
			$this->after();
        } else {
			throw new \Exception("action is not on curr obj", 404);
        }
	}
	
	protected function before()
	{
	}

	protected function after()
	{
	}

	protected function renderFile($filePathFromViewsFolder, array $params = []) {
		$params['flasNotifications'] = $this->getFlashMessages();
		View::renderFile($filePathFromViewsFolder, $params);
	}
	
	public function redirect($path) {
		header('Location: http://' . $_SERVER['HTTP_HOST'] . $path, true, 303);
		exit();
	}
}