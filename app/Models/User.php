<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends  = ['image'];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($record) {
            $record->uuid =  Str::uuid();
        });
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'networks', 'followed_by_id', 'following_id');
    }

    public function followedBy()
    {
        return $this->belongsToMany(User::class, 'networks', 'following_id', 'followed_by_id');
    }

    public function isFollowing(User $user)
    {
        return (bool)$this->following()->where('following_id', $user->id)->count();
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image'] != NULL && $this->attributes['image'] != '') {
            return config('constants.profile_image_url') . '/' . $this->attributes['image'];
        } else {
            return config('constants.profile_image_url') . '/profile.jpg';
        }
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
