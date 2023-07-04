<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Message extends Model
{
    use HasFactory;


    public $incrementing = false;
    
    protected $keyType = 'string';

    protected $fillable = [
        'content',
        'sender',
        'chat_room',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Uuid::uuid4();
        });

    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender');
    }

    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class, 'chat_room');
    }
}
