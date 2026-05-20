<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
  public $timestamps = false;
  protected $table = 'album';

  protected $fillable = [
    'nom',
    'artiste',
    'type',
    'date_sortie',
    'fichier_image'
  ];

  public function morceaux(){
    return $this->hasMany(Morceau::class, 'id_album');
  }
}
