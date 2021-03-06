<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //? setting default values for attributes
    protected $attributes = ['avatar' => 'gmuaQo7VUBIE9kAIRdXSzJav7DxFqPBTgykfMu5N.jpg'];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // eloquent mutator (there is also accesor for a different purpose)
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'user_id');
    }
    public function following()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }
}
