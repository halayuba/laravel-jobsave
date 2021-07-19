<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Jobs\{Submission, Interview};
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'email',
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

  public function avatar()
  {
    if (!$this->avatar) {
      /* == GRAB FROM GRAVATAR == */
      $avatar = "https://www.gravatar.com/avatar/" . md5($this->email) . "?s=80&d=mm";
      return $avatar;
    }
    return asset('storage/avatars/' . $this->avatar);
  }

  /* == STAT SUMMARY (IN "SubmissionCollection") == */
  /* == FIND INTERVIEWS FOR THIS USER WITH THE STATUS "COMPLETED" == */
  public function scopeCompletedInterviews($query)
  {
    /* == FOR THE DEMO: IF NO ONE IS SIGNED IN THEN ASSUME THE ADMIN IS SIGNED IN == */
    $userId = auth()->user() ? auth()->user()->id : 1;

    $query->where('user_id', $userId)
      ->interviews()
      ->where('interviews.status', 'Completed')
      ->count();
  }

  /* //====================
    //== RELATIONSHIPS
   //==================== */
  public function submissions()
  {
    return $this->hasMany(Submission::class);
  }

  public function interviews()
  {
    return $this->hasManyThrough(Interview::class, Submission::class);
  }
}
