<?php
namespace Core\Error;
use App\Config;
use Core\View\View;

class Error
{
    private static $exception;

    public static function errorHandler($severity, $message, $file, $line)
    {
        if (error_reporting() !== 0) {
            try {
                throw new \ErrorException($message, 0, $severity, $file, $line);
            } catch (\ErrorException $exception) {
                static::exeptionHandler($exception);
            }
        }
    }

    public static function exeptionHandler($exception)
    {
        try {
            self::$exception = $exception;
            $code = $exception->getCode();
            $shouldDisplayErrors = Config::DISPLAY_ERRORS;

            if ($code != 404) {
                $code = 500;
            }

            if ($shouldDisplayErrors) {
                self::dispayError();
                die;
            } else {
                self::logError();

                if ($code === 404) {
                    view::renderFile('404.php');
                    die;
                } else {
                    view::renderFile('500.php');
                    die;
                }
            }
        } catch(Exception $ex)
        {
            echo "*****************************";
            var_dump($ex);
        }
    }

    private static function dispayError() {
        $errorMsg = self::getExceptionsHtml();
        echo $errorMsg;
    }

    private static function logError () {
        $logFilesDir = (dirname(getcwd())).'/logs/';
        $logFilesName = date('y-m-d').'.txt';
        $logFilesPath = $logFilesDir.$logFilesName;

        ini_set("error_log", $logFilesPath);
        
        $errorMsg = self::getExceptionsHtml();
        error_log($errorMsg);
    }
    
    
    private static function getExceptionsHtml()
    {
        $exception = self::$exception;
        
        $errorMsg = "<h1>Fatal error</h1><br>";
        $errorMsg .= "<p>Uncaught exception: '" . get_class($exception) . "'</p><br>";
        $errorMsg .= "<p>Message: '" . $exception->getMessage() . "'</p><br>";
        $errorMsg .= "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p><br>";
        $errorMsg .= "<p>Thrown in '" . $exception->getFile() . "' on line <br>";
        $errorMsg .= $exception->getLine() . "</p><br>";

        return $errorMsg;
    }
}
