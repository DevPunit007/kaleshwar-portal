<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Organizer;
use App\User;

class CheckTeachersUserRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teacher-user-role:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if the user have role teacher if realtion to organzier_teacher is there';

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
        $teachers = Organizer::where('type', 'teacher')->with('admin')->get();
        foreach ($teachers as $teacher) {
            if($teacher->admin->rule_id < 3) {
                $user = User::where('id', $teacher->admin->id)->first();
                $user->rule_id = '3';
                $user->save();
                $this->output->write('Teacher ' . $teacher->admin->last_name . ' changed.', true);
            } else {
                $this->output->write('Teacher ' . $teacher->admin->last_name . ' is ok.', true);
            }
        }

        return;
    }
}
