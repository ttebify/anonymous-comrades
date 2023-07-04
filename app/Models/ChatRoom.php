<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ChatRoom extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';


    protected $fillable = [
        'name',
        'subject',
        'created_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Uuid::uuid4();
        });
    }


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}

