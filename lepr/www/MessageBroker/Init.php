<?php

namespace MessageBroker;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Config.php';
require_once __DIR__ . '/Rabbitmq.php';
require_once __DIR__ . '/Log.php';
require_once __DIR__ . '/Email.php';
require_once __DIR__ . '/Message.php';
require_once __DIR__ . '/Greeting.php';

class Init {
    private $connection;

    public function __construct()
    {
        $this->connection = new Rabbitmq(RABBIT_QUEUENAME, RABBIT_DELAY_EXCHANGENAME);

        $this->connection->listen();
    }
}

// Run initialization script
new Init();
