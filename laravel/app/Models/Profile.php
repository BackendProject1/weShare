<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function profileImage(){
        $imagePath= ($this->image)?$this->image:'/profile/kylie.jpg';
        return '/storage/' .$imagePath;
    }
    
    public function followers(){
        return $this ->belongsToMany(User::class);
    }
    // public function reactors(){
    //     return $this ->belongsToMany(User::class);
    // }

        // para naay relation ang profile from its user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
