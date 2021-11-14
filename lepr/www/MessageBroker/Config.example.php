<?php

// RabbitMQ Connection
define('RABBIT_HOST', 'lepr-rabbitmq');
define('RABBIT_PORT', '5672');
define('RABBIT_USERNAME', 'guest');
define('RABBIT_PASSWORD', 'guest');
define('RABBIT_QUEUENAME', 'MESSAGEBROKER');
define('RABBIT_DELAY_EXCHANGENAME', 'MESSAGEBROKER.delay');

// RabbitMQ Delay to Resave Message on Failed
// default is 60000 * 15 (15 minutes)
define('RABBIT_DELAY_MESSAGE', 60000 * 15);

// Gmail Service Account
define('GMAIL_USERNAME', 'username');
define('GMAIL_PASSWORD', 'password');
define('GMAIL_FROM', 'email name');
define('GMAIL_BCC', NULL);
