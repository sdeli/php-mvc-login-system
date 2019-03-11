<?php
namespace App\Model\RememberLogin;
use Core\Model\Model as Model; 
use App\Packages\Token\Token;
use App\Config as Config;

class RememberLogin extends Model
{
    public static function saveToken($userId)
    {
        $token = new Token();
        $hashedToken = $token->getHash();
        $expirySecsFromNow = Config::USER_AUTH_COOKIE_EXPIRY_SECS_FROM_NOW;

        $saveRememberLoginToken = 'call insertRememberMeTokenProc(:userId, :hashedToken, :expirySecsFromNow);';
        
        $pdoConn = static::getPdoConnection();

        $stmt = $pdoConn->prepare($saveRememberLoginToken);
    
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->bindParam(':hashedToken', $hashedToken, \PDO::PARAM_STR);
        $stmt->bindParam(':expirySecsFromNow', $expirySecsFromNow, \PDO::PARAM_STR);

        $wasNoErrorWhenSavingData = $stmt->execute();

        return ['token' => $hashedToken, 'expirySecsFromNow' => $expirySecsFromNow];
    }

    public static function deleteRememberLoginToken()
    {
        $sql = 'call deleteRememberLoginTokenProc(:rememberLoginToken);';
        
        $pdoConn = static::getPdoConnection();

        $stmt = $pdoConn->prepare($sql);
    
        $stmt->bindParam(':rememberLoginToken', $_COOKIE['userAuthToken'], \PDO::PARAM_STR);

        $stmt->execute();
        return true;
    }

    public static function getUserByRememberLoginToken($usersRememberLoginToken)
    {
        $sql = 'call getUserByRememberLoginTokenProc(:rememberLoginToken);';
        
        $pdoConn = static::getPdoConnection();

        $stmt = $pdoConn->prepare($sql);
    
        $stmt->bindParam(':rememberLoginToken', $usersRememberLoginToken, \PDO::PARAM_STR);

        $stmt->execute();
        $userObj = $stmt->fetch();
        return $userObj;
    }
}