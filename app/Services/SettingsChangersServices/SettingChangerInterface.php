<?php

namespace App\Services\SettingsChangersServices;

interface SettingChangerInterface
{
    /**
     * @param $newSettingData
     * @return string
     */
    public function rememberChangeAttempt($newSettingData): string;

    /**
     * @param int $messageSenderId
     * @return mixed
     */
    public static function rememberMessageSenderMethod(int $messageSenderId): mixed;

    /**
     * @return string
     */
    public function getSettingUpdateMethodInfo(): string;

    /**
     * @param $changeCode
     * @return array
     */
    public function getChangeAttempt($changeCode): array;
}
