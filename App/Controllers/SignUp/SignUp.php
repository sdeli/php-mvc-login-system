<?php 
namespace App\Controllers\SignUp;

use App\Config;

use Core\Controller\Controller as Controller;

use App\Controllers\SignUp\create\create;
use App\Controllers\SignUp\activateAccount\activateAccount;

use \App\Model\User\User as User;
use App\Packages\Token\Token;

class SignUp extends Controller
{
    use create;
    //use activateAccount; 

    function __construct($routeParams)
	{
        parent::__construct($routeParams);
    }
    
	protected function serveSignUpPage()
	{
        $params = [
            'siteId' => 'sign-up',
            'siteTitle' => 'Signup '
        ];

        $this->renderFile(Config::PATH_SIGN_UP_VIEW, $params);
	}
    
    protected function success()
    {
        $params = [
            'siteId' => 'sign-up',
            'siteTitle' => 'Signup '
        ];

        $this->renderFile(Config::PATH_SUCCEFUL_SIGN_UP_VIEW, $params);
    }

    protected function activateAccount()
    {
        // http://mvc/account/activate/0b0bde5a437422b7eb76cd980bfe6d15
        $activationToken = $this->routeParams['activationToken'];
        $activationTokenHash = (new Token($activationToken))->getHash();
        $userModel = User::getInstance();
        $activatedSuccedfully = $userModel->activateUser($activationTokenHash);

        if($activatedSuccedfully) {
            $this->addFlashMessage(static::SUCCESS, 'Your account has been succefully activated no you can log in');
            $this->redirect(Config::ROUTE_LOG_IN);
        } else {
            $this->redirect(Config::ROUTE_DENY_ACCOUNT_ACTIVATION);
        }
    }
    
    protected function denyAccountActivation()
    {
        $params = [
            'siteId' => Config::SITE_ID_DENY_ACCOUNT_ACTIVATION_VIEW,
            'siteTitle' => Config::SITE_TITLE_DENY_ACCOUNT_ACTIVATION_VIEW
        ];
    
        $this->renderFile(Config::PATH_DENY_ACCOUNT_ACTIVATION_VIEW, $params);
    }
}