<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use App\Services\MessagesService\MessagesServiceFactory;
use App\Services\SettingsChangersServices\SettingChangerFactory;
use App\Services\SettingsServices\SettingsFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Session\SessionFactory;

class UserSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserSetting  $userSetting
     * @return \Illuminate\Http\Response
     */
    public function show(UserSetting $userSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserSetting  $userSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSetting $userSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserSetting  $userSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSetting $userSetting)
    {
        $settingsChangerService = SettingChangerFactory::getSettingsChanger();
        $settingsService = SettingsFactory::getSettingsService();

        if ($request->has('change_code')) {
            $newSettingsData = $settingsChangerService->getChangeAttempt($request->input('change_code'));
            $settingsService->updateSettings($newSettingsData);

            $responseData = ['success' => true, 'message' => 'Settings updated successfully'];

            return response()->make($responseData);
        } else {
            $settingUpdateMethodInfo = $settingsChangerService->getSettingUpdateMethodInfo();
            $changeCode = $settingsChangerService->rememberChangeAttempt($request->input('new_setting_data'));

            $message = "We send you special code for updating data. $settingUpdateMethodInfo"
             . 'Please send response here with "change_code" param';

            $responseData = [
                'message' => $message,
            ];

            return response()->make($responseData);
        }
    }

    /**
     * @param Request $request
     * @return void
     */
    public function updateSettingsChangeMethod(Request $request): void
    {
        $acceptableValues = [
            MessagesServiceFactory::SMS_TYPE_ID,
            MessagesServiceFactory::EMAIL_TYPE_ID,
            MessagesServiceFactory::TELEGRAM_TYPE_ID
        ];

        $request->validate([
            'setting_changer_method_id' => ['required', 'integer', Rule::in($acceptableValues)]
        ]);

        $settingsChangerService = SettingChangerFactory::getSettingsChanger();
        $settingsChangerService::rememberMessageSenderMethod($request->input('setting_changer_method_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserSetting  $userSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSetting $userSetting)
    {
        //
    }
}
