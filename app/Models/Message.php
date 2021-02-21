<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Thread;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'thread_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function threads() {
        return $this->belongsTo(Thread::class);
    }
}
