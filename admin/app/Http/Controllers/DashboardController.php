<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Morceau;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
  public function index()
  {
    $albums = Album::with([
        'morceaux' => fn($q) => $q->orderBy('ordre')
      ])
      ->orderBy('id', 'desc')
      ->get();

    $morceauxSansAlbum = Morceau::whereDoesntHave('album')
      ->orderBy('ordre')
      ->get();

    $backups = Storage::disk('local')->files('backups');

    return view(
      'index', 
      [
        'albums' => $albums,
        'morceauxSansAlbum' => $morceauxSansAlbum,
        'backups' => $backups
      ]
    );
  }
}