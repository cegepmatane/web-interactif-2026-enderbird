<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
   protected $fillable = ['name'];

   public function morceaux()
   {
      return $this->hasMany(Morceau::class);
   }
}
