<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatApp extends Model
{
    //

    use HasFactory;

     protected $fillable = [
        'sender_id',
        'sender',
        'receiver_id',
        'message',
        'is_read',
        'sent_at',
    ];
}
