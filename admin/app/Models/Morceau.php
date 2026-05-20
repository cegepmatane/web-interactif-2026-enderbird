<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Morceau extends Model
{
  public $timestamps = false;
  protected $table = 'morceau';

  protected $fillable = [
    'id_album',
    'ordre',
    'titre',
    'artiste',
    'duree'
  ];

  public function album()
  {
    return $this->belongsTo(Album::class, 'id_album');
  }
}