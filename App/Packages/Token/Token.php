<?php
namespace App\Packages\Token;

class Token
{
    private $token;

    public function __construct($token = null)
    {
        if ($token) {
            $this->token = $token;
        } else {
            $newToken = bin2hex(random_bytes(16));
            $this->token = $newToken;
        }
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getHash()
    {
        return hash_hmac('sha256', $this->token, \App\Config::SECRET_KEY);
    }
}
