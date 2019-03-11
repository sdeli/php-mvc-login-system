<?php
namespace App\Controllers\Account;

use Core\Controller\Controller as Controller;

use App\Controllers\Account\isEmailReserved\isEmailReserved;

class Account extends Controller
{
    use isEmailReserved;       
}