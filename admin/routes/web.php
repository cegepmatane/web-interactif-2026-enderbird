<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  DashboardController as Dashboard,
  MorceauController as Morceau,
  AlbumController as Album,
  BackupController as Backup
};

// ROUTAGE
Route::get('/admin-test', function () {
  // À CHANGER
  session_start();

  // FONCTIONNE SEULEMENT SI UTILISATEUR PROF
  if (!isset($_SESSION['id_utilisateur']) || $_SESSION['id_utilisateur'] !== 1) {
    return redirect('/login');
  }

  return 'OK ADMIN';
});

Route::get('/', [Dashboard::class, 'index'])->name('index');

// Morceaux
Route::prefix('morceau')->name('morceau.')->group(function () {
  Route::get('/create', [Morceau::class, 'create'])->name('create');
  Route::post('/store', [Morceau::class, 'store'])->name('store');

  Route::get('/edit/{id}', [Morceau::class, 'edit'])->name('edit');
  Route::put('/update/{id}', [Morceau::class, 'update'])->name('update');

  Route::delete('/delete/{id}', [Morceau::class, 'delete'])->name('delete');
});

// Albums
Route::prefix('album')->name('album.')->group(function () {
  Route::get('/create', [Album::class, 'create'])->name('create');
  Route::post('/store', [Album::class, 'store'])->name('store');

  Route::get('/edit/{id}', [Album::class, 'edit'])->name('edit');
  Route::put('/update/{id}', [Album::class, 'update'])->name('update');

  Route::delete('/delete/{id}', [Album::class, 'delete'])->name('delete');
});

// Backup system
Route::prefix('backup')->name('backup.')->group(function () {
  Route::post('/create', [Backup::class, 'create'])->name('create');
  Route::post('/restore', [Backup::class, 'restore'])->name('restore');
});