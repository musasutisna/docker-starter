<?php

namespace MessageBroker;

class Greeting extends Message {

    public function __construct($arguments)
    {
        if ( ! parent::__construct()) {
            return;
        }

        $email = $arguments[0];
        $subject = 'Rabbitmq PHP';
        $message = 'Hi i am php script!';

        $sendMail = $this->email->send($email, $subject, $message);

        if ($sendMail === TRUE) {
            $this->successEmail('Greeting', $email, $message);
        } else {
            $this->failedEmail('Greeting', $email, $message . ' - ' . $sendMail);
        }
    }
}
