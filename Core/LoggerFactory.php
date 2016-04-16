<?php

namespace Sanja\Core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerFactory {
    public static function getLogger($loggerName) {
        // create a log channel
        $Log = new Logger('name');
        $StreamHandler = new StreamHandler(LOGS_DIR . $loggerName . '.log', Logger::WARNING);
        $Log->pushHandler($StreamHandler);

        return $Log;
    }
}