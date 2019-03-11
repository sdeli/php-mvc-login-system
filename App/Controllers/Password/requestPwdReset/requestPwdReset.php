<?php
namespace App\Controllers\Password\requestPwdReset;

use App\Config;
use App\Model\User\User;
use App\Packages\Mail\Mail;
use App\Model\TempPassword\TempPassword;

trait requestPwdReset
{
    protected function requestPwdReset() 
    {
        $userDetailsObj = $this->redirectToForgotPageIfNoUserByEmail();
        
        $tempPasswordModel = TempPassword::getInstance();
        $tempPassword = $tempPasswordModel->saveTempPassword();

        $name = $userDetailsObj->name;
        $to = $_POST['email'];

        $this->sendPasswordResetEmail($to, $name, $tempPassword);
        $this->renderEmailHasBeensentToYouPage();
    }
    
    private function redirectToForgotPageIfNoUserByEmail()
    {
        $userModel = User::getInstance();
        $userDetailsObj = $userModel->getUserDetailsByEmail($_POST['email']);
        $isUserInDbWithThisEmail = $userDetailsObj !== false;

        if (!$isUserInDbWithThisEmail) {
            // declining login
            $flashNotif = 'With this email there is no account, please try it again';
            $this->addFlashMessage(static::WARNING, $flashNotif);
            $this->forgotPage($_POST['email']);
            exit;
        } else {
            return $userDetailsObj;
        }
    }

    private function sendPasswordResetEmail($to, $name, $tempPassword)
    {
        $subject = 'Your new Temporary password';

        $paramsForTextTemplate = [
            'textTemplate' => Config::EMAIL_PATH_TEXT_TEMPLATE_PASSWORD_RESET, 
            'usersName' => $name,
            'temporaryPassword' => $tempPassword,
            'changeTempPwdLink' => Config::CHANGE_TEMP_PWD_LINK
        ];
        
        $paramsForHtmlTemplate = [
            'htmlTemplate' => Config::EMAIL_PATH_HTML_TEMPLATE_PASSWORD_RESET, 
            'usersName' => $name,
            'temporaryPassword' => $tempPassword,
            'changeTempPwdLink' => Config::CHANGE_TEMP_PWD_LINK
        ];

        ['text' => $text, 'html' => $html] = Mail::renderEmailHtml($paramsForTextTemplate, $paramsForHtmlTemplate);
        
        $email = new Mail($to, $name, $subject, $text, $html);
        $email->send();
    }

    private function renderEmailHasBeensentToYouPage () 
    {
        $params = [
            'siteId' => 'Change Your Temporary Password',
            'siteTitle' => 'change-temp-pwd',
            'email' => $_POST['email']
        ];

        $this->renderFile(Config::PATH_EMAIL_HAS_BEEN_SENT_VIEW, $params);
    }
}