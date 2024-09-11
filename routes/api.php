<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;


Route::middleware('auth:sanctum')->group(function () {
  Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
  Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
  Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');
  Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
  Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

  Route::get('/permissions', [RoleController::class, 'listPermission'])->name('permissions.list');
});

// Route::group(['middleware' => ['auth:sanctum']], function() {
// categories
Route::resource('categories',CategoryController::class);
Route::delete('categories_mass_destroy', [CategoryController::class, 'massDestroy'])->name('categories.mass_destroy');

// });


//livres 
Route::apiResource('books', BookController::class)->only('store', 'destroy');
Route::apiResource('books', BookController::class)->only('index', 'show');
Route::post('books/{book}', [BookController::class, 'update']);


Route::post('/chapters', [ChapterController::class, 'store']);
//route pour l'upload d'une video à un chapitre
Route::post('/chapters/{chapter}/upload-video', [ChapterController::class, 'uploadVideo']);
//lire video 
Route::get('/chapters/{id}/videos', [ChapterController::class, 'readVideo']);

// Ajoute une route pour permettre la conversion du PDF en images.
// Route::get('/chapters/{id}/convert', [ChapterController::class, 'convertToImages']);


//récupérationdu pdf d'un chapitre
Route::get('/chapter/{id}/download', [ChapterController::class, 'downloadPdf']);








//les routes du packege breez
Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');


// Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])
  ->middleware('auth:sanctum');

// Route::post('/login', [AuthenticatedSessionController::class, 'store'])
//     ->middleware('guest')
//     ->name('login');

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
//     ->middleware('auth:sanctum')
//     ->name('logout');