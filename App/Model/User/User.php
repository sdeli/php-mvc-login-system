<?php
namespace App\Model\User;

use Core\Model\Model as Model;

// packages
use App\Packages\Validate\Validate as Validate;
use App\Packages\Token\Token;

// traits
use App\Model\User\updateProfileData\updateProfileData;
use App\Model\User\save\save;

class User extends Model
{
    use save;
    use updateProfileData;

    public static function getInstance()
    {
        static $inst = null;

        if ($inst === null) {
            $inst = new User();
        }

        return $inst;
    }
    
    public function isEmailTaken($email, array &$errs = [])
    {
        $pdoConn = static::getPdoConnection();

        $sql = "call isEmailTakenProc(:currEmail);";
        $stmt = $pdoConn->prepare($sql);
        
        $stmt->bindParam(':currEmail', $email, \PDO::PARAM_STR);
        
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_OBJ);
        $isEmailTaken =  (bool)$result->isEmailTaken;

        if ($isEmailTaken) {
            $errs['emailErr'] = 'with this emailaddress there is already an account, please choose an other one';
            return $errs;
        } else {
            return false;
        }
    }

    public function getAutocommit()
    {
        $pdoConn = static::getPdoConnection();

        $sql = "select @@autocommit;";
        $stmt = $pdoConn->prepare($sql);
        
        $stmt->bindParam(':currEmail', $email, \PDO::PARAM_STR);
        
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        return $result;
    }

    public function getUserDetailsByEmail($email)
    {
        $sql = 'call getUserDetailsByEmailProc(:email);';
        
        $pdoConn = static::getPdoConnection();
        $stmt = $pdoConn->prepare($sql);
        
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->setFetchMode(\PDO::FETCH_OBJ);
        $stmt->execute();
        $userDataObj = $stmt->fetch();
        return $userDataObj;
    }

    public function getUserDetailsById($userId)
    {
        $sql = 'call getUserDetailsByIdProc(:userId);';
        
        $pdoConn = static::getPdoConnection();
        $stmt = $pdoConn->prepare($sql);
        
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_STR);
        $stmt->setFetchMode(\PDO::FETCH_OBJ);
        $stmt->execute();
        $userDataObj = $stmt->fetch();
        return $userDataObj;
    }

    public function updatePassword()
    {
        $validationErrs = Validate::validatePassword($_POST['password'], $_POST['passwordConf']);
        $isNewPwdValid = $validationErrs === false;
        
        if ($isNewPwdValid) {
            $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = 'call updatePasswordProc(:email, :newPwdHash);';

            $pdoConn = static::getPdoConnection();
            
            $stmt = $pdoConn->prepare($sql);
    
            $stmt->bindParam(':email', $_POST['email'], \PDO::PARAM_STR);
            $stmt->bindParam(':newPwdHash', $passwordHash, \PDO::PARAM_STR);
    
            $errs = $stmt->execute();
            return false;
        } else {
            return $validationErrs;
        }   
    }

    public function activateUser($activationhTokenHash)
    {
        $sql = 'update users
        set is_activated = true, activation_token_hash = null
        where activation_token_hash = :activationhTokenHash;';
        
        $pdoConn = static::getPdoConnection();
        $stmt = $pdoConn->prepare($sql);
        
        $stmt->bindParam(':activationhTokenHash', $activationhTokenHash, \PDO::PARAM_STR);
        $stmt->execute();
        $activatedSuccedfully = $stmt->rowCount() > 0;
        return $activatedSuccedfully;
    }
}