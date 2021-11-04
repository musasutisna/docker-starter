<?php

namespace MessageBroker;

class Message {
    public $success_message;
    public $error_message;

    public function __construct()
    {
        $this->email = new Email();

        return TRUE;
    }

    public function successEmail($action, $email, $msg)
    {
        $this->success_message = "Success send message $action to $email with content $msg";
    }

    public function failedEmail($action, $email, $msg)
    {
        $this->error_message = "Failed send message $action to $email with content $msg";
    }
}
