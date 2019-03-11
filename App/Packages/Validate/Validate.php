<?php
namespace App\Packages\Validate;

Class Validate
{   
    public static function validateEmailsFormat($email, array &$errs = [])
    {
        $didUserAddEmail = isset($email);
        if (!$didUserAddEmail) {
            $errs['emailErr'] = 'please type in an email adress';
            return;
        }

        $isEmailVlaid = (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$isEmailVlaid) {
            $errs['emailErr'] = 'you have typed in an invalid email address, please try again';
            return;
        }  
    }

    public static function validatePhone($phone, array &$errs = [])
    {
        $didUserAddPhoneNumb = isset($phone);

        if ($didUserAddPhoneNumb) {
            $isPhoneNumbVlaid = (bool)filter_var($phone, FILTER_VALIDATE_INT);
            $isPhoneNumbVlaid = strlen($phone) > 5 && $isPhoneNumbVlaid;

            if (!$isPhoneNumbVlaid) {
                $errs['phoneErr'] = 'you have typed in an invalid phone number, please try again';
            }
        } else {
            $errs['phoneErr'] = 'please type in an phone number';
        }
    }

    public static function validateName($name, array &$errs = [])
    {
        $didUserAddName = isset($name) && strlen($name) > 2;

        if ($didUserAddName) {
            $patternValidateName = "/^[a-zA-Z\-'\s]+$/";
            $userName = $name;
            $isNameValid = preg_match($patternValidateName, $userName, $matchesArr);
            $isNameValid = $isNameValid && strlen($name) > 2;

            if (!$isNameValid) {
                $errs['nameErr'] = 'please type in your valide name';
                return $errs;
            }
        } else {
            $errs['nameErr'] = 'please type in your name';
            return $errs;
        }
    }

    public static function validatePassword($password, $passwordConf, array &$errs = []) {
        $hasUserGivenAPwd = !empty($password);
        if (!$hasUserGivenAPwd) {
            $errs['passwordErr'] = 'please enter a valid password';
            return $errs;
        }
        
        $hasUserConfirmedPwd = !empty($passwordConf);
        if (!$hasUserConfirmedPwd) {
            $errs['passwordErr'] = 'Please confirm your password.'; 
            return $errs;
        }
        
        $doPwdAndConfMatch = $password === $passwordConf;
        if (!$doPwdAndConfMatch) {
            $errs['passwordErr'] = 'The password and it`s confirmation don`t match, please check it';
            return $errs;
        }
        
        $isPwdLongerThan7Chars = strlen($password) > 7;
        $doesContNumb = (bool)preg_match("#[0-9]+#",$password);
        $doesContCapLetter =  (bool)preg_match("#[A-Z]+#",$password);
        $doesContLowCaseLetter = (bool)preg_match("#[a-z]+#",$password);
        
        $isValidPwd = $isPwdLongerThan7Chars && $doesContNumb && $doesContCapLetter && $doesContLowCaseLetter;

        if (!$isValidPwd) {
            $errs['passwordErr'] = 'Your Passwrod is not enough secure! It must containt at least one Captial Letter, one Lowercase Letter, one Number and must be longer than 7 characters';
            return $errs;
        }

        return false;
    }
}

/*
$this-> = [
    'name' => "Sandor deli",
    'email' => "bgfkszmsdeli@gmail.com",
    'phone' => "123456",
    'password' => "BGFKSZMasd12345",
    'passwordConf' => "BGFKSZMasd12345"
];

$err = Validate::userDetails($this->);
var_dump($err);*/