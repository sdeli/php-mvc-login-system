<?php
namespace App\Controllers\SignUp\create;

use App\Config;

use App\Model\User\User;
use App\Packages\Mail\Mail;

trait create
{
    protected function create()
	{	
        $userModel = User::getInstance($_POST);
        $activationToken = $userModel->save();
        $areNoValidationErrs = !is_array($activationToken);

        if ($areNoValidationErrs) {
            $this->sendActivationEmail($activationToken);
            $this->addFlashMessage(static::SUCCESS ,'you are succesfully signed up now. You can login now with your new credentials if you want.');
            $this->redirect(Config::ROUTE_HOME);
        } else {
            $validationErrsArr = $activationToken;
            $this->denySignUp($validationErrsArr);
        }
    }
    
    private function denySignUp()
    {
        $userDetails = $_POST;
        $params = array_merge($userDetails, $validationErrsArr);
        $params ['siteId'] = 'sign-up';
        $params ['siteTitle'] = 'sign-up ';

        $this->addFlashMessage('we couldnt create an account for you with these credentials. Please try with other ones.');
        $this->renderFile(Config::PATH_SIGN_UP_VIEW, $params);
    }

    private function sendActivationEmail($activationToken)
    {
        $emailParams = [
            'usersName' => $_POST['name'],
            'accountActivationLink' => Config::ACTIVATE_ACCOUNT.$activationToken,
            'htmlTemplate' => 'activate-account/activate-account.txt',
            'textTemplate' => 'activate-account/activate-account.html'
        ];

        ['text' => $text, 'html' => $html] = Mail::renderEmailHtml($emailParams);
        $to = $_POST['email'];
        $name = $_POST['name'];
        $subject = Config::EMAIL_SUBJECT_ACTIVATE_ACCOUNT;

        $email = new Mail($to, $name, $subject, $text, $html);
        $email->send();
    }
}