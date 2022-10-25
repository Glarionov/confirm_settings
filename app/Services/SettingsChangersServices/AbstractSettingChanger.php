<?php

namespace App\Services\SettingsChangersServices;

use App\Services\MessagesService\MessageInterface;
use App\Services\MessagesService\MessagesServiceFactory;
use App\Services\SettingsServices\SettingsFactory;

class AbstractSettingChanger
{
    protected MessageInterface $messageSender;

    public function __construct()
    {
        $messageSenderId = static::getSenderMethodFromMemory();
        static::updateMessageSenderMethod($messageSenderId);
    }

    /**
     * @param int $messageSenderId
     * @return void
     */
    public function updateMessageSenderMethod(int $messageSenderId)
    {
        $this->messageSender = MessagesServiceFactory::getMessagesService($messageSenderId);
    }

    /**
     * @param int $messageSenderId
     * @return bool
     */
    public static function rememberMessageSenderMethod(int $messageSenderId): bool
    {
        $settingService = SettingsFactory::getSettingsService();
        return $settingService->updateSettings(['setting_changer_method_id' => $messageSenderId]);
    }

    /**
     * @return mixed
     */
    public static function getSenderMethodFromMemory()
    {
        $settingService = SettingsFactory::getSettingsService();
        return $settingService->getSetting('setting_changer_method_id');
    }
}
