<?php
namespace App\Packages\PasswordGenerator;

use App\Packages\PasswordGenerator\generateRandPassword\generateRandPassword;

class PasswordGenerator
{
    use generateRandPassword;
    protected $password;

    public function __construct() 
    {
        $this->password = $this->generateRandPassword();
    }

    public function getPassword()
    {
        return $this->password;                            
    }
}
