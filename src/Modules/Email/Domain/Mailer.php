<?php

namespace Modules\Email\Domain;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Mailer
{
    private Swift_SmtpTransport $transport;
    private ?Swift_Mailer $mailer = null;
    private ?Swift_Message $message = null;

    public function __construct()
    {
        $this->transport = new Swift_SmtpTransport(getenv('MAILHOG_HOST'), getenv('MAILHOG_PORT'));
    }

    /**
     * @return Swift_Mailer
     */
    public function getMailer(): Swift_Mailer
    {
        if (!$this->mailer) {
            $this->mailer = new Swift_Mailer($this->transport);
        }

        return $this->mailer;
    }

    /**
     * @return Swift_Message
     */
    public function getMessage(): Swift_Message
    {
        if (!$this->message) {
            $this->message = new Swift_Message();
        }

        return $this->message;
    }
}
