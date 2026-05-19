<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController as Welcome;
use App\Http\Controllers\ArticleController as Article;
use App\Http\Controllers\UsersController as Users;
use App\Http\Controllers\ContactController as Contact;
use App\Http\Controllers\Admin\{
  DashboardController as Dashboard,
  MorceauController as Morceau,
  AlbumController as Album,
  BackupController as Backup
};
use App\Http\Controllers\WizardController as Wizard;

// ROUTAGE

Route::get('/admin-test', function () {
    return 'OK ADMIN';
});

Route::get('/', [Welcome::class, 'index']);

Route::prefix('admin')->name('admin.')->group(function () {
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
});

Route::prefix('inscription')->group(function () {
    Route::get('/etape-1', [Wizard::class, 'step1']);
    Route::post('/etape-1', [Wizard::class, 'postStep1']);

    Route::get('/etape-2', [Wizard::class, 'step2']);
    Route::post('/etape-2', [Wizard::class, 'postStep2']);

    Route::get('/etape-3', [Wizard::class, 'step3']);
    Route::post('/etape-3', [Wizard::class, 'finish']);
});

Route::get('article/{n}', [Article::class, 'show'])->where('n', '[0-9]+');


Route::get('gome', function() { return 'Je suis la page 15 !'; });
Route::get('duc', function() { return 'Je suis la page 16 !'; });


Route::controller(Users::class)->group(function () {
    Route::get('users', 'getInfos');
    Route::post('users', 'postInfos');
});

Route::controller(Contact::class)->group(function () {
    Route::get('contact', 'getForm');
    Route::post('contact', 'postForm');
});

// [UsersController::class, 'method']