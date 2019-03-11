<?php
namespace App\Model\TempPassword;
use Core\Model\Model as Model;
use App\Config;
use App\Packages\PasswordGenerator\PasswordGenerator;

class TempPassword extends Model
{
    public static function getInstance()
    {
        static $inst = null;

        if ($inst === null) {
            $inst = new TempPassword();
        }

        return $inst;
    }

    public function saveTempPassword()
    {
        $tempPassword = (new PasswordGenerator())->getPassword();
        $tempPwdHash = password_hash($tempPassword, PASSWORD_DEFAULT);
        $expirySecsFromNow = Config::USER_AUTH_COOKIE_EXPIRY_SECS_FROM_NOW;

        $sql = 'call insertOrUpdateTmpPwdProc(:email, :tempPwdHash, :secondsFromNowToExpire);';
        
        $pdoConn = static::getPdoConnection();

        $stmt = $pdoConn->prepare($sql);
    
        $stmt->bindParam(':email', $_POST['email'], \PDO::PARAM_STR);
        $stmt->bindParam(':tempPwdHash', $tempPwdHash, \PDO::PARAM_STR);
        $stmt->bindParam(':secondsFromNowToExpire', $expirySecsFromNow, \PDO::PARAM_STR);

        $stmt->execute();

        return $tempPassword;
    }

    public function validateTempPassword()
    {
        $sql = 'call getTmpPwdHashProc(:email);';
        
        $pdoConn = static::getPdoConnection();
        $stmt = $pdoConn->prepare($sql);
        
        $stmt->bindParam(':email', $_POST['email'], \PDO::PARAM_STR);
        $stmt->setFetchMode(\PDO::FETCH_OBJ);
        $stmt->execute();
        $userDataObj = $stmt->fetch();

        $usersTempPwdHasInDb = $userDataObj->tmp_password_hash;
        $tempPwdTypedByUser = $_POST['tempPassword'];
        $doesTempPwdBelongToCurrUser = password_verify($tempPwdTypedByUser, $usersTempPwdHasInDb);
        
        return $doesTempPwdBelongToCurrUser;
    }
}