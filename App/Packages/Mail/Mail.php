<?php
namespace App\Packages\Mail;
use App\Packages\Mail\getMailer\getMailer;
use App\Config;

class Mail
{
    use getMailer;

    private $mailer;

    public function __construct($to, $name, $subject, $text, $html)
    {
        $this->mailer = $this->getMailer($to, $name, $subject, $text, $html);
    }

    public function send() 
    {
        $this->mailer->send();
    }

    public static function renderEmailHtml(array $textParams = [], array $htmlParams = [])
    {
        $wantsTheSameParamsForTextAndHtml = sizeof($htmlParams) === 0;
        if ($wantsTheSameParamsForTextAndHtml) $htmlParams = $textParams;

        $pathToEmailTemplates = Config::PATH_EMAIL_TEMPLATES_FOLDER; 
        $loader = new \Twig_Loader_Filesystem($pathToEmailTemplates);
        $twig = new \Twig_Environment($loader);
        
        $html = $twig->render($htmlParams['htmlTemplate'], $htmlParams);
        $text = $twig->render($textParams['textTemplate'], $textParams);

        return ['text' => $text, 'html' => $html];
    }
} 