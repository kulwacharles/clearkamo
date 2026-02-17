<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email', 
        'message',
        'sender_type',
        'is_read',
        'session_id'
    ];
    
    protected $casts = [
        'is_read' => 'boolean'
    ];
}
