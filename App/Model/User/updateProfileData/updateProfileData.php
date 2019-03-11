<?php
namespace App\Model\User\updateProfileData;
use App\Packages\Validate\Validate as Validate;
use App\Model\User\User;

trait updateProfileData
{
    public function updateProfileData($userId)
    {
        $validationErrs = $this->validateProfileData();
        $noValidationErrs = sizeof($validationErrs) === 0;
        
        if($noValidationErrs) {
            $pdoConn = static::getPdoConnection();

            $sql = $this->getSqlToUpdateProfile();
            
            $stmt = $this->prepareStmt($pdoConn, $sql, $userId);
            
            return $stmt->execute();
        } else {
            return $validationErrs;
        }
    }

    private static function validateProfileData()
    {
        $validationErrs = [];

        $doesUserChangeName = strlen($_POST['name']) > 0;
        if($doesUserChangeName) {
            Validate::validateName($_POST['name'], $validationErrs);
        }

        $doesUserChangeEmail = strlen($_POST['email']) > 0;
        if($doesUserChangeEmail) {
            Validate::validateEmailsFormat($_POST['email'], $validationErrs);
            $UserModel = User::getInstance();
            $UserModel->isEmailTaken($_POST['email'], $validationErrs);
        }

        $doesUserChangePassword = strlen($_POST['password']) > 0;
        if($doesUserChangePassword) {
            Validate::validatePassword($_POST['password'], $_POST['passwordConf'], $validationErrs);
        }

        return $validationErrs;
    }
    
    private function getSqlToUpdateProfile()
    {
        $sql = 'update users set';
        
        // if required name change
        $sql = strlen($_POST['name']) > 0 ? $sql.' users.name = :name' : $sql; 
        // if required email change
        $sql = strlen($_POST['email']) > 0 ? $sql.', users.email = :email' : $sql; 
        // if required password change
        $sql = strlen($_POST['password']) > 0 ? $sql.', users.password_hash = :passwordHash' : $sql; 
        
        $sql .= ' where users.user_id = :userId';
        
        return $sql;
    }
    
    private function prepareStmt($pdoConn, $sql, $userId)
    {
        $stmt = $pdoConn->prepare($sql);
        // if required name change
        if (strlen($_POST['name']) > 0) $stmt->bindParam(':name', $_POST['name'], \PDO::PARAM_STR);
        
        // if required email change
        if (strlen($_POST['email']) > 0) $stmt->bindParam(':email', $_POST['email'], \PDO::PARAM_STR);
        
        // if required password change
        if (strlen($_POST['password']) > 0) {
            $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bindParam(':passwordHash', $passwordHash, \PDO::PARAM_STR);
        }
        
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);

        return $stmt;
    }
}
