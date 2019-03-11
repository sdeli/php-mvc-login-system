<?php
namespace Core\Controller\Auth;

use Core\Controller\Auth\Flash\Flash as Flash;
use Core\Controller\Auth\AuthUtils\AuthUtils as AuthUtils;

class Auth extends Flash
{
    use AuthUtils;
    
    private $UserModel;
    private $RememberLoginModel;

    function __construct($UserModel, $RememberLoginModel)
    {
        $this->UserModel = $UserModel::getInstance();
        $this->RememberLoginModel = $RememberLoginModel;
    }
    
    public function logOutUser()
    {
        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
        
        session_destroy();

        if (isset($_COOKIE['userAuthToken'])) {
            $this->forgetUserAuthTokenInCokkie();
            $this->RememberLoginModel::deleteRememberLoginToken();
        }
    }

    public static function checkIfUserLoggedIn()
    {
        $isUserLoggedIn = isset($_SESSION['userId']);
        return $isUserLoggedIn;
    }

    public function logInUser($userObj, $shouldRemeberLogin = false)
    {
        session_regenerate_id(true);
        $_SESSION['userId'] = $userObj->user_id;

        if ($shouldRemeberLogin) {
            $userAuthTokenData = $this->RememberLoginModel::saveToken($userObj->user_id);
            $this->setUserAuthTokenInCokkie($userAuthTokenData['token'], $userAuthTokenData['expirySecsFromNow']);
        }
    }

    public function authUser($currEmail, $currPwd)
    {
        $useDataObj = $this->UserModel->getUserDetailsByEmail($currEmail);
        $isUserSignedUp = $useDataObj !== false;

        if ($isUserSignedUp) {
            $isPasswordCorrect = password_verify($currPwd, $useDataObj->password_hash);

            if ($isPasswordCorrect) {
                return $useDataObj;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function rememberRequestedPage()
    {
        $_SESSION['returnTo'] = $_SERVER['REQUEST_URI'];
    }

    public function getReturnPage()
    {
        return $_SESSION['returnTo'] ?? '/';
    }

    public function getLoggedInUser()
    {
        $isUserLoggedInBySession = isset($_SESSION['userId']);
        if ($isUserLoggedInBySession) {
            $userObj = $this->UserModel->getUserDetailsById($_SESSION['userId']);
            return $userObj;
        } 
        
        $hasRememberLoginCookie = isset($_COOKIE['userAuthToken']);
        if ($hasRememberLoginCookie) {
            $usersRememberLoginToken = $_COOKIE['userAuthToken'];
            $userObj = $this->RememberLoginModel::getUserByRememberLoginToken($usersRememberLoginToken);
            $isCookieNotExpired = $userObj !== false;

            if ($isCookieNotExpired) {
                $this->logInUser($userObj);
                return $userObj;
            } else {
                return false;
                $this->forgetUserAuthTokenInCokkie();
            }
        }

        return false;
    }

    /*public function getLoggedInUser2()
    {
        $isUserLoggedInBySession = isset($_SESSION['userId']);

        if ($isUserLoggedInBySession) {
            $userObj = $this->UserModel::getUserDetailsById($_SESSION['userId']);
            return $userObj;
        } else {
            $hasRememberLoginCookie = isset($_COOKIE['userAuthToken']);

            if ($hasRememberLoginCookie) {
                $usersRememberLoginToken = $_COOKIE['userAuthToken'];
                $userObj = getUserByRememberLoginToken($usersRememberLoginToken);
            } else {
                return false;
            }
        } 
    }*/

    public function requireBeingLoggedIn($pathToRedirectIfNotLoggedIn, $callbackFn = false, $callbackParams = [])
    {
        $userObj = $this->getLoggedInUser();

        if (!$userObj) {
            $this->rememberRequestedPage();
            $callbackFn(extract($callbackParams));
            $redirecPath = 'Location: http://'.$_SERVER['HTTP_HOST'].$pathToRedirectIfNotLoggedIn;
            header($redirecPath, true, 303);
            exit();
        }

        return $userObj;
    }
}