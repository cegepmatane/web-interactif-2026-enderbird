<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Morceau;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class BackupController extends Controller
{
  private $backupPasswordHash = '$2y$12$s.4s3Wd6fdVXKHcyaI9Q.uO6uLw53faw9dldpPYE/tQmgghsDCZWK';

  public function create(Request $request)
  {
    if (!Hash::check($request->password, $this->backupPasswordHash)) {
      return response()->json(['error' => 'Mot de passe invalide'], 403);
    }

    $data = [
      'albums' => Album::all(),
      'morceaux' => Morceau::all(),
    ];

    $fileName = 'backup_' . now()->format('Y_m_d_H_i_s') . '.json';

    Storage::put('backups/' . $fileName, json_encode($data));

    return response()->json(['success' => true, 'file' => $fileName]);
  }

  public function restore(Request $request)
  {
    if (!Hash::check($request->password, $this->backupPasswordHash)) {
      return response()->json(['error' => 'Mot de passe invalide'], 403);
    }

    $data = json_decode(Storage::get($request->file), true);

    Morceau::truncate();
    Album::truncate();

    foreach ($data['albums'] as $album) {
      Album::create($album);
    }

    foreach ($data['morceaux'] as $morceau) {
      Morceau::create($morceau);
    }

    return response()->json(['success' => true]);
  }
}