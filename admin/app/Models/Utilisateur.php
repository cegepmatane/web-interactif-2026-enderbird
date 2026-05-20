<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Utilisateur extends Model 
{
  public $timestamps = false;
  protected $table = 'utilisateur';

  protected $fillable = [
    'pseudo',
    'email',
    'mot_de_passe',
    'fichier_image'
  ];
  
  public function setMotDePasseAttribute($value)
  {
    $this->attributes['mot_de_passe'] = Hash::make($value);
  }
}
