<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'bio',
        'avatar',
        'password',
        'email',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function chatRooms()
    {
        return $this->hasMany(ChatRoom::class, 'created_by');
    }

    public function messages()
    {
        return $this->hasMany(Messages::class, 'sender');
    }

    public function userSettings()
    {
        return $this->hasMany(UserSettings::class, 'user_id');
    }
}
