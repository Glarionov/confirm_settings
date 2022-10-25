<?php

namespace App\Services\MessagesService;

class MessagesServiceFactory
{
    const SMS_TYPE_ID = 1;

    const EMAIL_TYPE_ID = 2;

    const TELEGRAM_TYPE_ID = 3;

    /**
     * @param $messagesTypeId
     * @return MessageInterface
     */
    public static function getMessagesService($messagesTypeId = null): MessageInterface
    {
        $messagesTypeId = $messagesTypeId ?? self::SMS_TYPE_ID;

        # Предполагается, что тут он выдаст конкретный класс для работы с сообщениями
    }
}
