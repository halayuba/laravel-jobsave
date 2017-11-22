<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $guarded = ['id', 'user_id'];

    protected $dates = ['last_update'];

    public function getRouteKeyName()
    {
        return 'title';
    }

    public function scopeOwns($query)
    {
        $query->where('user_id', auth()->id());
    }

    public function scopeUploadedFile($query, $filename)
    {
        $query->where('file', $filename);
    }

    public function fileUploadExists($val)
    {
      return $this->uploadedFile($val)->count();
    }

    public function inUse()
    {
      return ($this->applications !== NULL && $this->applications->count());
    }

    public function hasNoUpload()
    {
      return $this->file == NULL;
    }

    //== RELATIONSHIPS
   //====================
   public function applications()
   {
       return $this->hasMany(Application::class);
   }

   public function uploads()
   {
       return $this->morphMany(Upload::class, 'uploadable');
   }

   public function user()
   {
       return $this->belongsTo(User::class);
   }
}
