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
                ->setUsername(Config::instance()->data['mailer']['login'])
                ->setPassword(Config::instance()->data['mailer']['password']);
        $this->mailer = \Swift_Mailer::newInstance($this->transport);
    }

    public function send($message)
    {
        $this->message = \Swift_Message::newInstance()
            ->setFrom(Config::instance()->data['mailer']['from'])
            ->setTo(Config::instance()->data['admin']['email'])
            ->setSubject('Ошибка подключения к БД')
            ->setBody($message);
        $this->mailer->send($this->message);
    }
}