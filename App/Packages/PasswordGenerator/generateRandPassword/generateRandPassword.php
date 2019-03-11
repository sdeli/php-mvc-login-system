<?php
namespace App\Packages\PasswordGenerator\generateRandPassword;

trait generateRandPassword
{
    protected function generateRandPassword() 
    {
        $password = "";
        $pwdLength = rand(9, 13);
    
        for ($i=0; $i < $pwdLength; $i++) { 
            $password .= $this->getRandChar();			
        }
        
        return $password;
    }

    private function getRandChar() 
    {
        $charset = str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-*/");
        $randomChar = $charset[rand(0, strlen($charset) -1)];
    
        return $randomChar;		
    }
}