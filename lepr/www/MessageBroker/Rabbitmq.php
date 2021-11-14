<?php

namespace MessageBroker;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class Rabbitmq {
    private $connection;
    private $channel;
    private $queueName;
    private $exchangeName;

    public function __construct($queueName, $exchangeName)
    {
        $this->connection = new AMQPStreamConnection(RABBIT_HOST, RABBIT_PORT, RABBIT_USERNAME, RABBIT_PASSWORD);
        $this->channel = $this->connection->channel();
        $this->queueName = $queueName;
        $this->exchangeName = $exchangeName;

        $this->channel->queue_declare($this->queueName, false, false, false, false);
        $this->channel->exchange_declare(
            $this->exchangeName, 'x-delayed-message', false, false, false, false, false, new AMQPTable([
            'x-delayed-type' => 'direct'
        ]));
        $this->channel->queue_bind($this->queueName, $this->exchangeName);
        $this->channel->basic_consume(
            $this->queueName, '', false, true, false, false,
            [$this, 'callback']
        );
    }

    public function callback($msg)
    {
        $log = new Log('Rabbitmq');
        $command = $this->parsingCommand($msg->body);
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
                    $this->reSaveMessage($msg->body);
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

    public function parsingCommand($command)
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

    public function reSaveMessage($msgBody)
    {
        $newMessage = new AMQPMessage($msgBody, [
            'delivery_mode' => 2,
            'application_headers' => new AMQPTable([
                'x-delay' => RABBIT_DELAY_MESSAGE
            ])
        ]);

        $this->channel->basic_publish($newMessage, $this->exchangeName);
    }
}
