<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    use HasUlids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'content',
        'sender',
        'chat_room',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class, 'chat_room');
    }
}
