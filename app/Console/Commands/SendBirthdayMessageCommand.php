<?php

namespace App\Console\Commands;

use App\Mail\UserBirthdayMessage;
use App\NewsletterLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use OwenIt\Auditing\Models\Audit;

class SendBirthdayMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday-message:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a birthday message to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::whereHas('personalInformation', function ($query) { $query->whereNotNull('user_personal_information.date_of_birth'); })->with('personalInformation')->get();
        foreach ($users as $user) {
            if ($user->status == 1) {
                $birthday = $user->personalInformation->date_of_birth;
                $birthday_current_year = str_replace(substr($birthday, 0, 4), Carbon::today()->year, $birthday);
                if ($birthday_current_year == Carbon::today()->format('Y-m-d')) {
                    try {
                        $birthday_mail = new UserBirthdayMessage($user);
                        Mail::to($user->email)->send($birthday_mail);       //->bcc('thomas@stenzel.pro')
                        NewsletterLog::create([
                            'user_id' => $user->id,
                            'newsletter_id' => '0',
                            'result' => 'birthday message succesfully sent'
                        ]);
                        $this->output->write('Birthday message sent to ' . $user->first_name . ' ' . $user->last_name, true);
                    } catch (\Exception $e) {
                        NewsletterLog::create([
                            'user_id' => $user->id,
                            'newsletter_id' => '0',
                            'result' => $e
                        ]);
                        $this->output->write('Failure with birthday message to ' . $user->first_name . ' ' . $user->last_name, true);
                    }
                }
            }
        }

        return 1;
    }
}
