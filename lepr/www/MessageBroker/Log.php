<?php

namespace MessageBroker;

use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log {
    private $log;

    public function __construct($logName)
    {
        $formatOutput = "%level_name% - %datetime% --> %message%\n";
        $formatDate = "Y-m-d H:i:s";
        $logFilename = __DIR__ . '/logs/message-broker-' . date('Y-m-d') . '.log';

        $this->log = new Logger($logName);
        $stream = new StreamHandler($logFilename);
        $formatter = new LineFormatter($formatOutput, $formatDate);

        $stream->setFormatter($formatter);
        $this->log->pushHandler($stream, Logger::DEBUG);
    }

    public function success($msg)
    {
        $this->log->info($msg);
    }

    public function failed($msg)
    {
        $this->log->info($msg);
    }

    public function error($msg)
    {
        $this->log->error($msg);
    }
}
