<?php
namespace Core\Controller\Auth\AuthUtils;

trait AuthUtils
{
    private function setUserAuthTokenInCokkie($token, $expirySecsFromNow)
    {
        $name = 'userAuthToken';
        $expiryTimestamp = time() + 123455;
        $expiryTimestampFormated = date('Y-m-d H:i:s', $expiryTimestamp);
        $path = '/';
        $domain = $_SERVER['HTTP_HOST'];;
        $secure = isset($_SERVER["HTTPS"]); 
        $httponly = false;

        setcookie ($name, $token, $expiryTimestamp, $path, $domain, $secure, $httponly);
    }

    private function forgetUserAuthTokenInCokkie()
    {
        $name = 'userAuthToken';
        $path = '/';
        $domain = $_SERVER['HTTP_HOST'];;
        $secure = isset($_SERVER["HTTPS"]); 
        $httponly = false;

        setcookie ($name, '', strtotime('-1 year'), $path, $domain, $secure, $httponly);
    }
}
