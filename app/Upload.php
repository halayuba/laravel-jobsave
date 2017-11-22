<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $guarded = ['id'];

    public function uploadable()
    {
        return $this->morphTo();
    }
}
