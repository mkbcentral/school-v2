<?php

namespace App\Livewire\Helpers\Notifications;

use Mediumart\Orange\SMS\Http\SMSClient;
use Mediumart\Orange\SMS\SMS;

class SmsNotificationHelper
{
    public static function sendSMS($from,$to,$message){
        $client = SMSClient::getInstance('ACeaRnhCMY34MfLAQjJTB6u23qZjV1TS', 'sMTqUVPXMygphZWT');
        $sms = new SMS($client);
        $sms->message($message)
            ->from($from)
            ->to($to)
            ->send();
    }
}
