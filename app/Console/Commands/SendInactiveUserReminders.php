<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendInactiveUserReminder;
use App\Models\User;

class SendInactiveUserReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trigger reminder jobs for inactive users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $inactiveAfterDays = config('inactive-users.inactive_after_days');
        $users = User::query()
            ->whereNotNull('last_login_at')
            ->where('last_login_at', '<=', now()->subDays($inactiveAfterDays))
            ->whereDoesntHave('reminderLogs', function ($query) {
                $query->whereDate('sent_at', today());
            })
            ->select('id')
            ->get();

        foreach ($users as $user) {
            SendInactiveUserReminder::dispatch($user->id);
        }

        $this->info("Dispatched {$users->count()} reminder job(s).");

        return self::SUCCESS;

    }
}
