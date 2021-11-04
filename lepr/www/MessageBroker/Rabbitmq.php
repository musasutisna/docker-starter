<?php

namespace MessageBroker;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Rabbitmq {
    private $connection;
    private $channel;

    public function __construct($queueName)
    {
        $this->connection = new AMQPStreamConnection(RABBIT_HOST, RABBIT_PORT, RABBIT_USERNAME, RABBIT_PASSWORD);
        $this->channel = $this->connection->channel();

        $this->channel->queue_declare($queueName, false, false, false, false);
        $this->channel->basic_consume($queueName, '', false, true, false, false, [Rabbitmq::class, 'callback']);
    }

    public static function callback($msg)
    {
        $log = new Log('Rabbitmq');
        $command = self::parsingCommand($msg->body);
        $message = NULL;

        try {
            // greeting;email address
            if ($command['action'] === 'greeting') {
                $message = new Greeting($command['arguments']);
            }

            if ( ! is_null($message)) {
                if ( ! is_null($message->success_message)) {
                    $log->success($message->success_message);
                } else {
                    $log->failed($message->error_message);
                }
            } else {
                $log->failed('no action');
            }
        } catch (\Exception $err) {
            $log->error($err->getMessage());
        } catch (\ErrorException $err) {
            $log->error($err->getMessage() . ' ' . $err->getFile() . ':' . $err->getLine());
        } catch (\Throwable $err) {
            $log->error($err->getMessage() . ' ' . $err->getFile() . ':' . $err->getLine());
        }
    }

    public static function parsingCommand($command)
    {
        $commandSplit = explode(';', $command);
        $commandAction = $commandSplit[0];
        $commandArguments = array_slice($commandSplit, 1);

        return [
            'action' => $commandAction,
            'arguments' => $commandArguments
        ];
    }

    public function listen()
    {
        while ($this->channel->is_open()) {
            $this->channel->wait();
        }
    }
}
