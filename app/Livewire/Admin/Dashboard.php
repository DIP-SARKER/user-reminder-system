<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;

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
}
