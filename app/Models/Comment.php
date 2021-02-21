<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'body'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function posts() {
        return $this->belongsTo(Comment::class);
    }
}