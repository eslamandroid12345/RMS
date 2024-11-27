<?php

namespace App\Console\Commands;

use App\Mail\NoReportSentWarning;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ReportDelayEmailSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report-delay-email-send';

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
        $users = User::whereHasRole('user')->whereDoesntHave('reports',function ($query){
            $query->whereDate('created_at',now()->format('Y-m-d'));
        })->get();
        foreach ($users as $user){
            Mail::to($user)->send(new NoReportSentWarning($user));
        }
        return 1;

    }
}
