<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReminderLog extends Model
{
    protected $fillable = [
        'user_id',
        'sent_at',
        'channel',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];
}
