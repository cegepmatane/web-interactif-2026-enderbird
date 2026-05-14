<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\BackupController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WizardController;

Route::get('/', [WelcomeController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Morceaux
    Route::get('/morceaux/create', [AdminController::class, 'createMorceau'])->name('admin.morceaux.create');
    Route::post('/morceaux/store', [AdminController::class, 'storeMorceau'])->name('admin.morceaux.store');

    Route::get('/morceaux/edit/{id}', [AdminController::class, 'editMorceau'])->name('admin.morceaux.edit');
    Route::put('/morceaux/update/{id}', [AdminController::class, 'updateMorceau'])->name('admin.morceaux.update');

    Route::delete('/morceaux/delete/{id}', [AdminController::class, 'destroyMorceau'])->name('admin.morceaux.destroy');

    // Albums
    Route::get('/albums/create', [AdminController::class, 'createAlbum'])->name('admin.albums.create');
    Route::post('/albums/store', [AdminController::class, 'storeAlbum'])->name('admin.albums.store');

    Route::get('/albums/edit/{id}', [AdminController::class, 'editAlbum'])->name('admin.albums.edit');
    Route::put('/albums/update/{id}', [AdminController::class, 'updateAlbum'])->name('admin.albums.update');

    Route::delete('/albums/delete/{id}', [AdminController::class, 'destroyAlbum'])->name('admin.albums.destroy');

    // Backup system
    Route::post('/backup/create', [AdminController::class, 'createBackup'])->name('admin.backup.create');
    Route::post('/backup/restore', [AdminController::class, 'restoreBackup'])->name('admin.backup.restore');
});



Route::prefix('inscription')->group(function () {
    Route::get('/etape-1', [WizardController::class, 'step1']);
    Route::post('/etape-1', [WizardController::class, 'postStep1']);

    Route::get('/etape-2', [WizardController::class, 'step2']);
    Route::post('/etape-2', [WizardController::class, 'postStep2']);

    Route::get('/etape-3', [WizardController::class, 'step3']);
    Route::post('/etape-3', [WizardController::class, 'finish']);
});

Route::get('article/{n}', [ArticleController::class, 'show'])->where('n', '[0-9]+');


Route::get('gome', function() { return 'Je suis la page 15 !'; });
Route::get('duc', function() { return 'Je suis la page 16 !'; });


Route::controller(UsersController::class)->group(function () {
    Route::get('users', 'getInfos');
    Route::post('users', 'postInfos');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('contact', 'getForm');
    Route::post('contact', 'postForm');
});

// [UsersController::class, 'method']