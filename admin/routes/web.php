<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  DashboardController as Dashboard,
  MorceauController as Morceau,
  AlbumController as Album// ,
  // BackupController as Backup
};

Route::get('/', [Dashboard::class, 'index'])->name('index');
// Morceaux
Route::prefix('morceau')->name('morceau.')->group(function () {
  Route::get('/creer', [Morceau::class, 'creer'])->name('creer');
  Route::post('/enregistrerCreation', [Morceau::class, 'enregistrerCreation'])->name('enregistrerCreation');

  Route::get('/modifier/{id}', [Morceau::class, 'modifier'])->name('modifier');
  Route::put('/enregistrerModifications/{id}', [Morceau::class, 'enregistrerModifications'])->name('enregistrerModifications');

  Route::delete('/supprimer/{id}', [Morceau::class, 'supprimer'])->name('supprimer');
});
// Albums
Route::prefix('album')->name('album.')->group(function () {
  Route::get('/creer', [Album::class, 'creer'])->name('creer');
  Route::post('/enregistrerCreation', [Album::class, 'enregistrerCreation'])->name('enregistrerCreation');

  Route::get('/modifier/{id}', [Album::class, 'modifier'])->name('modifier');
  Route::put('/enregistrerModifications/{id}', [Album::class, 'enregistrerModifications'])->name('enregistrerModifications');

  Route::delete('/supprimer/{id}', [Album::class, 'supprimer'])->name('supprimer');
});

// // Backup system
// Route::prefix('backup')->name('backup.')->group(function () {
//   Route::post('/create', [Backup::class, 'create'])->name('create');
//   Route::post('/restore', [Backup::class, 'restore'])->name('restore');
// });