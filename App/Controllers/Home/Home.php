<?php 

namespace App\Controllers\Home;
use Core\Controller\Controller as Controller;
use App\Config;

use App\Model\Posts\Posts as Posts;

class Home extends Controller
{
	function __construct($routeParams)
	{
        parent::__construct($routeParams);
	}

	protected function displayPosts()
	{
		$userObj = $this->requireBeingLoggedIn('/login', function() {
			$msg = 'For viewing the posts you need to be loged in, so please login or sign up. Thanks';
			$this->addFlashMessage(static::SUCCESS, $msg);
		});

		$posts = Posts::getAllPosts();
		$postsCount = sizeof($posts);

		$paramsForTemplate = [
			'posts' => $posts,
			'postsCount' => $postsCount,
			'siteId' => 'Posts',
			'siteTitle' => 'posts',
			'userObj' => $userObj
		];
		
		$this->renderFile(Config::PATH_POST_FEED_VIEW, $paramsForTemplate);
	}

	protected function serveHomePage()
	{	
		$params = [
            'siteId' => 'home',
			'siteTitle' => 'Home',
			'currUser' => $this->getLoggedInUser()
		];
		
		$this->renderFile(Config::PATH_HOME_VIEW, $params);
	}

	protected function shoppingCart()
	{	
		$userObj = getloggedinuser();

		if ($userObj) {
			datafromModel = getDataForLoggidinUser();

			$params = [
				'siteId' => 'home',
				'siteTitle' => 'Home',
				'currUser' => $this->getLoggedInUser()
			];
			
			$this->renderFile(Config::SHOPPING_CART_VIEW, $params);
		} else {
			$datafromModel = getDataForNotLoggidinUser();

			$params = [
				'siteId' => 'home',
				'siteTitle' => 'Home',
				'currUser' => $this->getLoggedInUser()
			];
			
			$this->renderFile(Config::SHOPPING_CART_VIEW, $params);
		}

	}
}