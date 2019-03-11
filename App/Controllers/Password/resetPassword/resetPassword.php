<?php
namespace App\Controllers\Password\resetPassword;

use App\Config;

use App\Model\TempPassword\TempPassword;
use App\Model\User\User;

trait resetPassword
{
    protected function resetPassword()
    {
        $tempPasswordModel = TempPassword::getInstance();
        $isTempPasswordValid = $tempPasswordModel->validateTempPassword();
        
        if ($isTempPasswordValid) {
            $userModel = User::getInstance();
            $pwdValidationErrs = $userModel->updatePassword();
    
            if (!$pwdValidationErrs) {
                $this->renderLoginWithSuccessNotifPage();
            } else {
                $this->refusePwdReset('Your Email or temporary passowrd is not correct, or the temporary password has expired and you need to request a new one', $pwdValidationErrs);
            }
        } else {
            $this->refusePwdReset('Your Email or temporary passowrd is not correct, or the temporary password has expired and you need to request a new one');
        };
    }

    private function refusePwdReset($flashNotif)
    {
        $this->addFlashMessage(static::WARNING, $flashNotif);
        
        $params = [
            'siteId' => 'Change Your Temporary Password',
            'siteTitle' => 'change-temp-pwd',
            'email' => $_POST['email']
        ];
        
        $this->renderFile(Config::PATH_CHANGE_TEMP_PWD_VIEW, $params);
    }
    
    private function renderLoginWithSuccessNotifPage()
    {
        $this->addFlashMessage(static::SUCCESS, 'Your password have been succesfully updated now you can log on');
        
        $params = [
            'siteId' => 'log-in',
            'siteTitle' => 'Login ',
            'email' => $_POST['email'],
            'hasAttempetedToSignIn' => true,
            'isRememberLoginChecked' => false
        ];
        
        $this->renderFile(Config::PATH_LOG_IN_VIEW, $params);
    }
}