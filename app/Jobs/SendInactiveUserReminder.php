<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\ReminderLog;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SendInactiveUserReminder implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $userId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::find($this->userId);

        if (!$user) {
            return;
        }

        $alreadySentToday = ReminderLog::query()
            ->where('user_id', $user->id)
            ->whereDate('sent_at', today())
            ->exists();

        if ($alreadySentToday) {
            return;
        }

        Log::info('Inactive user reminder sent.', [
            'user_id' => $user->id,
            'email' => $user->email,
        ]);


        ReminderLog::create([
            'user_id' => $user->id,
            'sent_at' => now(),
            'channel' => 'log',
        ]);
    }
}
