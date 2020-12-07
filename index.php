<?php

require_once __DIR__ . '/vendor/autoload.php';

use vcamelot\RouteeTest\Notification\Notification;

$notification = new Notification('Dmitry', 'Vinogradov', '+380503723788');
$result = $notification->run();
if (!$result) {
    echo $notification->getLastError() . PHP_EOL;
} else {
    echo "The notification has been sent with result: " . $notification->getLastError() . PHP_EOL;
}
