<?php
namespace App\Controllers\SignUp\activateAccount;

use App\Model\User\User;
use App\Packages\Token\Token;

use App\Config;

trait activateAccount
{
    protected function activateAccount()
    {
        // http://mvc/account/activate/0b0bde5a437422b7eb76cd980bfe6d15
        $activationToken = $this->routeParams['activationToken'];
        $activationTokenHash = (new Token($activationToken))->getHash();
        $userModel = User::getInstance();
        $activatedSuccedfully = $userModel->activateUser($activationTokenHash);

        if($activatedSuccedfully) {
            $this->addFlashMessage(static::SUCCESS, 'Your account has been succefully activate no you can log in');
            $this->redirect(Config::ROUTE_LOG_IN);
        } else {
            $this->redirect(Config::ROUTE_DENY_ACCOUNT_ACTIVATION);
        }
    }
}