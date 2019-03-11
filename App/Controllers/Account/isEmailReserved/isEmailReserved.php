<?php
namespace App\Controllers\Account\isEmailReserved;
use App\Model\User\User;

trait isEmailReserved
{
    protected function isEmailReserved()
    {
        $currUsersId = isset($_POST['userId']) ? $_POST['userId'] : null;
    
        $userModel = User::getInstance();
        $userDetails = $userModel->getUserDetailsByEmail($_POST['email']);
        $isEmailFree = $userDetails === false;
    
        if (!$isEmailFree) {
            $doesEmailBelongToCurrUser = $currUsersId === $userDetails->user_id;
    
            if ($doesEmailBelongToCurrUser) {
                $isEmailFree = true;
            }
        }
    
        header('Content-Type: application/json');
        echo json_encode($isEmailFree);
    }
}