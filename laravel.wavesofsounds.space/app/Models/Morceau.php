<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Morceau extends Model
{
    protected $table = 'morceaux';

    protected $fillable = [
        'id_album',
        'name',
        'ordre',
        'titre',
        'artiste',
        'duree'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}