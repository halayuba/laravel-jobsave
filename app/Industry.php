<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
  public function employers()
  {
      return $this->hasMany(Employer::class);
  }
}
