<?php

namespace App\Http\Controllers\Admin;
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
    ])->get();

    $morceauxSansAlbum = Morceau::whereNull('album_id')->orderBy('ordre')->get();

    $backups = Storage::disk('local')->files('backups');

    return view(
      'admin.index', 
      [
        'albums' => $albums,
        'morceauxSansAlbum' => $morceauxSansAlbum,
        'backups' => $backups
      ]
    );
  }
}