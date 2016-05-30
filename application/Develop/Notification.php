<?php

namespace Develop;

/**
 * Класс для отправки оповещений разработчикам и заинтересованным лицам
 * об ошибках, происходящих в автоматических процессах проекта. Например
 * интеграция с сервисами логистики по крону или автодеплой проекта.
 *
 * Class Notification
 * @package Develop
 */
class Notification
{
    /**
     * Эмейлы, на которые надо отправить оповещение
     *
     * @var string[]
     */
    public static $emails = array(
        "mr.wertmax@gmail.com"
    );

    /**
     * Отправляет оповещения по всем сервисам
     *
     * @param string $subject
     * @param string $message
     */
    public static function notify ($subject = "", $message = "")
    {
        static::sendEmails($subject, $message);
    }

    /**
     * отправляет email'ы
     *
     * @param string $subject
     * @param string $message
     */
    public static function sendEmails ($subject = "", $message = "")
    {
        $subject = $_SERVER[""] . $subject;
        foreach (static::$emails as $email) {
            mail($email, $subject, $message);
        }
    }
}