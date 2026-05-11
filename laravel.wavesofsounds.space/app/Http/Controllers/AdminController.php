<?php

namespace App\Http\Controllers;

use App\Models\Morceau;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private $backupPasswordHash = '$2y$12$s.4s3Wd6fdVXKHcyaI9Q.uO6uLw53faw9dldpPYE/tQmgghsDCZWK';

    // -------------------------
    // DASHBOARD
    // -------------------------
    public function index()
    {
        $albums = Album::with([
            'morceaux' => fn($q) => $q->orderBy('ordre')
        ])->get();

        $morceauxSansAlbum = Morceau::whereNull('album_id')
            ->orderBy('ordre')
            ->get();

        $backups = Storage::disk('local')->files('backups');

        return view('admin.index', compact(
            'albums',
            'morceauxSansAlbum',
            'backups'
        ));
    }

    // -------------------------
    // MORCEAUX
    // -------------------------
    public function create()
    {
        return view('admin.create', ['albums' => Album::all()]);
    }

    public function store(Request $request)
    {
        Morceau::create($request->all());
        return redirect('/admin');
    }

    public function edit($id)
    {
        return view('admin.edit', [
            'morceau' => Morceau::findOrFail($id),
            'albums' => Album::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        Morceau::findOrFail($id)->update($request->all());
        return redirect('/admin');
    }

    public function destroy($id)
    {
        Morceau::destroy($id);
        return redirect('/admin');
    }

    // -------------------------
    // ALBUMS
    // -------------------------
    public function createAlbum()
    {
        return view('admin.albums.create');
    }

    public function storeAlbum(Request $request)
    {
        $request->validate(['name' => 'required']);

        Album::create($request->only('name'));

        return redirect()->route('admin.index');
    }

    public function editAlbum($id)
    {
        return view('admin.albums.edit', [
            'album' => Album::findOrFail($id)
        ]);
    }

    public function updateAlbum(Request $request, $id)
    {
        Album::findOrFail($id)->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.index');
    }

    public function destroyAlbum($id)
    {
        Album::destroy($id);
        return redirect('/admin');
    }

    // -------------------------
    // BACKUPS
    // -------------------------
    public function createBackup(Request $request)
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

    public function restoreBackup(Request $request)
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