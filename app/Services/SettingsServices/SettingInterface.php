<?php

namespace App\Services\SettingsServices;

interface SettingInterface
{
    public function updateSettings($newSettingsData): bool;

    public function getSetting($settingName): mixed;
}
