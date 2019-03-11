<?php 
namespace App\Controllers\Password;

use App\Config;

use Core\Controller\Controller as Controller;
use App\Controllers\Password\requestPwdReset\requestPwdReset;
use App\Controllers\Password\resetPassword\resetPassword;

class Password extends Controller
{
    use requestPwdReset;
    use resetPassword;

    protected function forgotPage($email = false) 
    {
        $params = [
            'siteId' => 'Forgot Passowrd',
            'siteTitle' => 'forgot',
            'usersEmail' => $email
        ];

        $this->renderFile(Config::PATH_FORGOT_PASSWORD_VIEW, $params);
    }

    protected function changeTempPassword() 
    {
        $params = [
            'siteId' => 'Change Your Temporary Password',
            'siteTitle' => 'change-temp-pwd',
        ];

        $this->renderFile(Config::PATH_CHANGE_TEMP_PWD_VIEW, $params);
    }
}