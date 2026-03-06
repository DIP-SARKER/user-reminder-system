<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        $users = User::query()
            ->with([
                'reminderLogs' => function ($query) {
                    $query->latest('sent_at');
                }
            ])
            ->latest()
            ->get();
        return view('livewire.admin.dashboard', [
            'users' => $users,
        ]);
    }

    public function runScheduler(): void
    {
        if (!auth()->user()?->is_admin) {
            abort(403);
        }

        try {
            Artisan::call('app:run-scheduler');

            $output = Artisan::output();

            session()->flash('success', $output ?: 'Scheduler command executed successfully.');

            $this->users = User::with('reminderLogs')->latest()->get();
        } catch (\Throwable $e) {
            session()->flash('error', 'Failed to run scheduler.');
        }
    }
}
