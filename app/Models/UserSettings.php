<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class UserSettings extends Model
{
    use HasFactory;
    
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id', 'name', 'value'
    ];

    protected $casts = [
        'value' => 'json',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Uuid::uuid4();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
