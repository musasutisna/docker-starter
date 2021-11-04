<?php

require_once __DIR__ . '/MessageBroker/vendor/autoload.php';
require_once __DIR__ . '/MessageBroker/Config.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$message = NULL;
$email = NULL;

function sendMessage($message) {
    $connection = new AMQPStreamConnection(RABBIT_HOST, RABBIT_PORT, RABBIT_USERNAME, RABBIT_PASSWORD);
    $channel = $connection->channel();

    $channel->queue_declare('MESSAGEBROKER', false, false, false, false);

    $msg = new AMQPMessage($message);
    $channel->basic_publish($msg, '', 'MESSAGEBROKER');
}

if (isset($_POST['kirim'])) {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        
        sendMessage("greeting;$email");
        
        $message = 'Success Send Email!';
    } else {
        $message = 'Email address could not be empty!';
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="/index.php" style="display:flex;position:fixed;align-items:center;justify-content:center;width:100%;height:100%;">
            <?php echo is_null($message) ? ('<p style="text-align:center;display:flex">' . $message . '</p><br/>') : ''; ?>
            <input type="email" name="email" placeholder="Enter email address">
            <button type="submit" name="kirim">Send Greeting</button>
        </form>
    </body>
</html>
