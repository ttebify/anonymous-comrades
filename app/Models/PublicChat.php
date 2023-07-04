<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicChat extends Model
{

    public static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $uid = uniqid();
            while (self::where('uuid', $uid)->count() > 0) {
                $uid = uniqid();
            }
            $item->uuid = $uid;
        });
    }

    protected $fillable = [
        'content', 'hidden', 'createdBy'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'createdBy');
    }
}
