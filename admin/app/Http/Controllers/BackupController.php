<?php

namespace App\Http\Controllers;
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

  // public function create(Request $request)
  // {
  //   if (!Hash::check($request->password, $this->backupPasswordHash)) {
  //     return response()->json(['error' => 'Mot de passe invalide'], 403);
  //   }
  
  //   $fileName = 'backup_' . now()->format('Y_m_d_H_i_s');
  
  //   // JSON backup (existing)
  //   $data = [
  //     'albums'   => Album::all(),
  //     'morceaux' => Morceau::all(),
  //   ];
  //   Storage::put('backups/' . $fileName . '.json', json_encode($data));
  
  //   // SQL backup
  //   $dbName = config('database.connections.mysql.database');
  //   $dbUser = config('database.connections.mysql.username');
  //   $dbPass = config('database.connections.mysql.password');
  //   $dbHost = config('database.connections.mysql.host');
  
  //   $sqlPath = storage_path('app/backups/' . $fileName . '.sql');
  
  //   exec("mysqldump -h {$dbHost} -u {$dbUser} -p{$dbPass} {$dbName} > {$sqlPath}");
  
  //   return response()->json([
  //     'success' => true,
  //     'json'    => $fileName . '.json',
  //     'sql'     => $fileName . '.sql',
  //   ]);
  // }
  // public function restore(Request $request)
  // {
  //   if (!Hash::check($request->password, $this->backupPasswordHash)) {
  //     return response()->json(['error' => 'Mot de passe invalide'], 403);
  //   }

  //   $file = $request->file;
  //   $extension = pathinfo($file, PATHINFO_EXTENSION);

  //   if ($extension === 'sql') {
  //     $dbName = config('database.connections.mysql.database');
  //     $dbUser = config('database.connections.mysql.username');
  //     $dbPass = config('database.connections.mysql.password');
  //     $dbHost = config('database.connections.mysql.host');

  //     $sqlPath = storage_path('app/backups/' . $file);

  //     if (!file_exists($sqlPath)) {
  //       return response()->json(['error' => 'Fichier introuvable'], 404);
  //     }

  //     exec("mysql -h {$dbHost} -u {$dbUser} -p{$dbPass} {$dbName} < {$sqlPath}", $output, $exitCode);

  //     if ($exitCode !== 0) {
  //       return response()->json(['error' => 'Restauration SQL échouée'], 500);
  //     }

  //     return response()->json(['success' => true, 'type' => 'sql']);
  //   }

  //   // existing JSON restore
  //   if ($extension === 'json') {
  //     $data = json_decode(Storage::get('backups/' . $file), true);

  //     Morceau::truncate();
  //     Album::truncate();

  //     foreach ($data['albums'] as $album) {
  //       Album::create($album);
  //     }

  //     foreach ($data['morceaux'] as $morceau) {
  //       Morceau::create($morceau);
  //     }

  //     return response()->json(['success' => true, 'type' => 'json']);
  //   }

  //   return response()->json(['error' => 'Format de fichier non supporté'], 422);
  // }
}