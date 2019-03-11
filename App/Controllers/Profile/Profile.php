<?php
namespace App\Controllers\Profile;
use Core\Controller\Controller as Controller;

// Routs
use App\Controllers\Profile\View\View as view;
use App\Controllers\Profile\Edit\Edit as edit;

class Profile extends Controller
{
    use view;
    use edit;
}