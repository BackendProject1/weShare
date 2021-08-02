<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user){

            $user->profile()->create([
                'title'=>$user->username
            ]);
        });
    }
// para sa post of each user
    public function posts(){
        return $this ->hasMany(Post::class)->orderBy('created_at','DESC');
    }
// to make relation para sa mga ifollow nimu
    public function following(){
        return $this->belongsToMany(Profile::class);
    } 
    // public function liked(){
    //     return $this->belongsToMany(Profile::class);
    // }
// para naay profile each user
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function reacts()
    {
        return $this->hasMany(React::class);
    }
}
