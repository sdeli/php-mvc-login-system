<?php
namespace Core\Controller\Auth\Flash;

abstract class Flash
{
    const SUCCESS = 'success';

    const INFO = 'info';

    const WARNING = 'warning';

    public static function addFlashMessage($type = 'success', $flasNotification) {
        if (!isset($_SESSION['flasNotifications'])) {
            $_SESSION['flasNotifications'] = [];
        }

        $_SESSION['flasNotifications'][] = [
            'body' => $flasNotification,
            'type' => $type
        ];
    }

    public static function getFlashMessages() {
        if (isset($_SESSION['flasNotifications'])) {
            $flasNotifications = $_SESSION['flasNotifications'];
            unset($_SESSION['flasNotifications']);
            return $flasNotifications;
        } else {
            return [];
        }
    }
}
