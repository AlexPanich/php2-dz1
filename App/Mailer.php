<?php


namespace App;


class Mailer
{
    use Singleton;

    protected $transport;
    protected $message;
    protected $mailer;

    protected function __construct()
    {
        $this->transport = \Swift_MailTransport::newInstance();
        $this->mailer = \Swift_Mailer::newInstance($this->transport);
    }

    public function send($message)
    {
        $this->message = \Swift_Message::newInstance()
            ->setTo(Config::instance()->data['email']['admin'])
            ->setBody($message);
        $this->mailer->send($this->message);
    }
}