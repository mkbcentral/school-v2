<?php

namespace App\Console\Commands;

use App\Livewire\Helpers\Notifications\SmsNotificationHelper;
use App\Models\User;
use Illuminate\Console\Command;

class SendSMSCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users=User::all();
        foreach ($users as $user) {
            SmsNotificationHelper::sendSMS(
                '+243898337969',
                '+243' . $user->phone,
                "C.S.AQUILA\n Juste un essaie technique \nA: ".date('Y-m-d H:i:s')
            );
        }
        $this->comment("SMS bien envoyés");
    }
}
