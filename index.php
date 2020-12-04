<?php

require_once __DIR__ . '/vendor/autoload.php';

use vcamelot\RouteeTest\Notification\Notification;

try {
    $notification = new Notification('Dmitry', 'Vinogradov', '+380503723788');
} catch (Exception $e) {
    echo $e->getMessage();
}
