<?php
namespace App;

class Config 
{
    const HOST = 'localhost';
    const DOMAIN_NAME = 'mvc';
    const USERNAME = 'root';
    const DBNAME = 'mvc';
    const PASSWORD = 'dalias19';
    const DISPLAY_ERRORS = true;
    const SECRET_KEY = 'r0wgeKRhZta1FLjqFmQI3FKShkCnvBhz';
    const SMTP_HOST = 'smtp.gmail.com';
    const EMAIL_ADDR_USER_NAME = 'sandor.deli.javascript@gmail.com';
    const EMAIL_ADDR_PASSWORD = 'Bgfkszm1234';
    const EMAIL_ADDR_FROM = 'sandor.deli.javascript@gmail.com';
    const EMAILERS_NAME = 'mvc';
    const USER_AUTH_COOKIE_EXPIRY_SECS_FROM_NOW = 60 * 60 * 24 * 30 * 12;
    const CHANGE_TEMP_PWD_LINK = 'http://mvc/password/change-temp-password';
    const TEMP_PWD_EXPIRY_SECS_FROM_NOW = 60 * 60 * 24;

    // =========== VIEWS =============

    // VIEW FOLDER PATH
    const PATH_VIEWS_FOLDER = '../App/views';

    // HOME
    const PATH_HOME_VIEW = '/home/home.php';

    // LOGIN VIEW
    const PATH_LOG_IN_VIEW = '/log-in/log-in.php';
    const SITE_TITLE_LOG_IN_VIEW = 'Login';
    const SITE_ID_LOG_IN_VIEW = 'login';
    const LINK_LOG_IN_VIEW = self::DOMAIN_NAME.'/login';
    
    // SIGN-UP
    const PATH_SIGN_UP_VIEW = '/sign-up/sign-up.php';
    const SITE_ID_SIGN_UP_VIEW = 'Sign Up';
    const SITE_TITLE_SIGN_UP_VIEW = 'sign-up';
    
    // PROFILE
    const PATH_PROFILE_VIEW = '/profile/profile.php';
    const SITE_ID_PROFILE_VIEW = 'Profile';
    const SITE_TITLE_PROFILE_VIEW = 'profile';
    
    // DENY_ACCOUNT_ACTIVATION
    const PATH_DENY_ACCOUNT_ACTIVATION_VIEW = '/sign-up/deny-account-activation.php';
    const SITE_TITLE_DENY_ACCOUNT_ACTIVATION_VIEW = 'Account Status';
    const SITE_ID_DENY_ACCOUNT_ACTIVATION_VIEW = 'deny-account-activation';
    const LINK_DENY_ACCOUNT_ACTIVATION_VIEW = 'login';
    

    const PATH_CHANGE_TEMP_PWD_VIEW = '/password/change-temp-pwd.php';
    const PATH_FORGOT_PASSWORD_VIEW = '/password/forgot-password.php';
    const PATH_EMAIL_HAS_BEEN_SENT_VIEW = '/password/email-has-been-sent.php';
    
    const PATH_POST_FEED_VIEW = '/posts/posts-feed.php';
    
    
    const PATH_SUCCEFUL_SIGN_UP_VIEW = '/sign-up/succeful-sign-up.php';

    // ROUTS
    const ROUTE_DENY_ACCOUNT_ACTIVATION = '/sign-up/deny-account-activation';
    
    // LINKS
    const ACTIVATE_ACCOUNT = 'http://mvc/sign-up/activate-account/'/*token is needed*/;
    const ROUTE_PROFILE_VIEW = '/profile/view';
    const ROUTE_LOG_IN = '/login';
    const ROUTE_HOME = '/';
    
    // ======== EMAIL ==========
    const PATH_EMAIL_TEMPLATES_FOLDER = '../App/assets/email-templates';

    const EMAIL_SUBJECT_ACTIVATE_ACCOUNT = '$_SERVER[\'SERVER_NAME\'] - Account Activation';
    const EMAIL_PATH_HTML_TEMPLATE_ACCOUNT_ACTIVATION = '/activate-account/activate-account.html';
    const EMAIL_PATH_TEXT_TEMPLATE_ACCOUNT_ACTIVATION = '/activate-account/activate-account.txt';

    const EMAIL_PATH_HTML_TEMPLATE_PASSWORD_RESET = '/password-reset/password_reset.html';
    const EMAIL_PATH_TEXT_TEMPLATE_PASSWORD_RESET = '/password-reset/password_reset.txt';

    
}