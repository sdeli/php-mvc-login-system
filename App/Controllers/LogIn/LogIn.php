<?php 
namespace App\Controllers\LogIn;
use Core\Controller\Controller as Controller;

use App\Config;

class LogIn extends Controller
{
    function __construct($routeParams)
	{
        parent::__construct($routeParams);
    }
    
    protected function servelogInPage($email = false, $shouldRemeberLogin = false)
    {
        if ($this->checkIfUserLoggedIn()) {
            $this->addFlashMessage(static::INFO, 'You are redirected to home-page from login since you are logged in');
            $this->redirect(Config::ROUTE_HOME);
        };
        
        $params = [
            'siteId' => 'log-in',
            'siteTitle' => 'Login ',
            'email' => $email,
            'hasAttempetedToSignIn' => true,
            'isRememberLoginChecked' => $shouldRemeberLogin
        ];
        
        if ($email) {
            $params['deniedLoginMsg'] = 'There has been some problem with your email or password. Please try again';
        }
        
        $this->renderFile(Config::PATH_LOG_IN_VIEW, $params);
    }
    
    protected function maylogInUser()
    {
        $currEmail = $_POST['email'];
        $currPwd = $_POST['password'];
        $shouldRemeberLogin = isset($_POST['rememberLogin']) ? true : false;
        
        $userObj = $this->authUser($currEmail, $currPwd);
        $areCredentialsCorrect = $userObj !== false;
        
        if ($areCredentialsCorrect) {
            $this->logInUser($userObj, $shouldRemeberLogin);
            $returnPagepath = $this->getReturnPage();
            $this->addFlashMessage(static::SUCCESS, 'You Are succesfully logged in Now');
            $this->redirect($returnPagepath);
        } else {
            // declining login
            $flashNotif = 'Your email or password is not correct. Please try it again or request a new password';
            $this->addFlashMessage(static::WARNING, $flashNotif);
            $this->servelogInPage($currEmail, $shouldRemeberLogin);
        }
    }
    
    protected function logOutUserRoute()
    {
        $isUserStillLoggedIn = $this->checkIfUserLoggedIn();
        
        if ($isUserStillLoggedIn) {
            $this->logOutUser();
        }

        // logoutuser kills the curr session so we can not send a masg via $_SESSION so we need to redirect for new session
        $this->addFlashMessage(static::SUCCESS, 'You Are succesfully logged out now');
        $this->redirect(Config::ROUTE_HOME);
    }
    
    protected function showLogOutMsg() 
    {
        $flashNotif = 'You have been succefully logged out';
        $this->addFlashMessage(static::INFO, $flashNotif);
        $this->redirect(Config::PATH_LOG_IN_VIEW);
    }
}