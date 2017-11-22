<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_active', 'activation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //== RELATIONSHIPS
   //====================
   public function resumes()
   {
       return $this->hasMany(Resume::class);
   }

   public function employers()
   {
       return $this->hasMany(Employer::class);
   }

   public function jobs()
   {
       return $this->hasMany(Job::class);
   }

   public function applications()
   {
       return $this->hasMany(Application::class);
   }

   public function interviews()
   {
       return $this->hasMany(Interview::class);
   }

   public function offers()
   {
       return $this->hasMany(Offer::class);
   }

}
