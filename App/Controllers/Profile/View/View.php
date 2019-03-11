<?php

namespace App\Controllers\Profile\View;
use App\Config;

trait View 
{
    protected function view () {
        $userObj = $this->requireBeingLoggedIn(Config::ROUTE_LOG_IN, function() {
            $msg = 'for accessing your profile you need to be logged in so please login';
            $this->addFlashMessage(static::SUCCESS, $msg);
        });
    
        $params = [
            'siteId' => 'profile',
            'siteTitle' => "Profile for $userObj->name",
            'userId' => $userObj->user_id, 
            'email' => $userObj->email,
            'name' => $userObj->name
        ];
        
        $this->renderFile(Config::PATH_PROFILE_VIEW, $params);
    }
}