<?php

namespace App\Controllers\Profile\Edit;
use App\Config;
use App\Model\User\User;

trait Edit 
{
    protected function edit () {
        $userObj = $this->requireBeingLoggedIn(Config::PATH_LOG_IN_VIEW, function() {
            $msg = 'for accessing your profile you need to be logged in so please login';
            $this->addFlashMessage(static::SUCCESS, $msg);
        });

        $userModel = User::getInstance();
        $validationErrs = $userModel->updateProfileData($userObj->user_id);

        $changesCanBeUpdated = $validationErrs === true;
        if ($changesCanBeUpdated) {
            $this->addFlashMessage(static::SUCCESS, 'Your Profile Details Have been Succesfully updated');
            $this-> redirect(Config::ROUTE_PROFILE_VIEW);
        } else {
            $this->renderRefuseUpdate($userObj, $validationErrs);
        }
    }

    private function renderRefuseUpdate($userObj, $validationErrs)
    {
        $params = [
            'siteId' => 'profile',
            'siteTitle' => "Profile for $userObj->name",
            'userId' => $userObj->user_id, 
            'email' => $userObj->email,
            'name' => $userObj->name
        ];
        
        $params = array_merge($params, $validationErrs);
        $this->renderFile(Config::PATH_PROFILE_VIEW, $params);
    }
}