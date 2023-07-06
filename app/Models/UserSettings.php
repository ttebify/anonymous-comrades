<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id', 'name', 'value',
    ];

    protected $casts = [
        'value' => 'json',
    ];

    const SETTINGS = [
        'default_chat_style' => 'elegant',
        'public_chat_visibility' => false
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
