<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
use App\Models\User;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function messages() {
        return $this->hasMany(Message::class);
    }
}
