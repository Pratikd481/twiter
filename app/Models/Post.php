<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($record) {
            $record->uuid =  Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
