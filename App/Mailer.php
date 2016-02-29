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
        $this->transport = \Swift_SmtpTransport::newInstance('smtp.yandex.ru', 465, 'ssl')
                ->setUsername('secret')
                ->setPassword('secret');
        $this->mailer = \Swift_Mailer::newInstance($this->transport);
    }

    public function send($message)
    {
        $this->message = \Swift_Message::newInstance()
            ->setFrom('secret')
            ->setTo(Config::instance()->data['email']['admin'])
            ->setSubject('Ошибка подключения к БД')
            ->setBody($message);
        $this->mailer->send($this->message);
    }
}