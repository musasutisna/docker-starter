<?php

namespace MessageBroker;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email {
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(FALSE);

        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 465;
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->SMTPAuth = TRUE;
        $this->mail->Username = GMAIL_USERNAME;
        $this->mail->Password = GMAIL_PASSWORD;

        $this->mail->isSMTP();
        $this->mail->isHTML(TRUE);
        $this->mail->ClearAddresses();
        $this->mail->ClearCCs();
        $this->mail->ClearBCCs();
        $this->mail->setFrom(GMAIL_USERNAME, GMAIL_FROM);

        if ( ! is_null(GMAIL_BCC)) {
            $this->mail->addBCC(GMAIL_BCC);
        }
    }

    public function send($to, $subject, $message, $files = FALSE)
    {
        $this->mail->Subject = $subject;
        $this->mail->Body = $message;

        $this->mail->AddAddress($to);

        if (is_array($files)) {
            foreach ($files AS $filename => $filepath) {
                $this->mail->addAttachment($filepath, $filename);
            }
        } else if ($files) {
            $this->mail->addAttachment($files);
        }

        $result = $this->mail->send();

        if ( ! $result) {
            return $this->mail->ErrorInfo;
        } else {
            return TRUE;
        }
    }
}
