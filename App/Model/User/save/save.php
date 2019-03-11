<?php
namespace App\Model\User\save;

use App\Packages\Validate\Validate as Validate;
use App\Packages\Token\Token;

trait save
{
    public function save()
    {
        $validationErrs = $this->validateUserCredentials();
        $userCredentialsAreValid = empty($validationErrs);
        
        if ($userCredentialsAreValid) {
            $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $activationTokenObj = new Token();
            $activationToken = $activationTokenObj->getToken();
            $activationTokenHash = $activationTokenObj->getHash();

            $sql = 'call saveUserProc(:userName, :email, :passwordHash, :authToken);';
            $pdoConn = static::getPdoConnection();
            $stmt = $pdoConn->prepare($sql);
    
            $stmt->bindParam(':userName', $_POST['name'], \PDO::PARAM_STR);
            $stmt->bindParam(':email', $_POST['email'], \PDO::PARAM_STR);
            $stmt->bindParam(':passwordHash', $passwordHash, \PDO::PARAM_STR);
            $stmt->bindParam(':authToken', $activationTokenHash, \PDO::PARAM_STR);
    
            $stmt->execute();

            return $activationToken;
        } else {
            return $validationErrs;
        }
    }

    private function validateUserCredentials() {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
        $validationErrs = [];
        
        Validate::validateEmailsFormat($email, $validationErrs);
        $pdoConn = static::getPdoConnection();
        self::isEmailTaken($email, $validationErrs);
        Validate::validateName($name, $validationErrs);
        Validate::validatePassword($password, $passwordConf, $validationErrs);
        
        return $validationErrs;
    }
}