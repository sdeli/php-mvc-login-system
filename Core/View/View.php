<?php
namespace Core\View;
use App\Config;

class View
{
    static function renderFile($filePathFromViewsFolder, array $paramters = [])
    {
        $areNoParamters = sizeof($paramters) === 0;

        if ($filePathFromViewsFolder === '404.php') {
            $paramters = [
                'siteId' => '404',
                'siteTitle' => '404 - Site'
            ];
        } else if ($filePathFromViewsFolder === '500.php') {
            $paramters = [
                'siteId' => '500',
                'siteTitle' => '500 - Site'
            ];
        }

        extract($paramters, EXTR_SKIP);
        
        $filePath = Config::PATH_VIEWS_FOLDER.$filePathFromViewsFolder;
        
        require $filePath;
    }
}
