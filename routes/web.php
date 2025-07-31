<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\CotisationDepenseController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Email de vérification envoyé.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// For admin
Route::prefix('admin')->name('admin.')->middleware('web')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.submit');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminManagementController::class, 'showPromotionForm'])->name('dashboard');
        Route::post('/promote', [AdminManagementController::class, 'promote'])->name('promote');
        Route::delete('/remove', [AdminManagementController::class, 'remove'])->name('remove');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        // Cotisations et Depenses
        Route::get('/showInfo', [CotisationDepenseController::class, 'showInfo'])->name('showInfo');
        Route::post('/cotisations/create', [CotisationDepenseController::class, 'storeCotisation'])->name('cotisations.storeCotisation');
        Route::post('/depenses/create', [CotisationDepenseController::class, 'storeDepense'])->name('depenses.storeDepense');

        Route::prefix('depenses')->name('depenses.')->group(function () {
            Route::get('/{id}/download', [CotisationDepenseController::class, 'downloadJustificatif'])->name('download');
            Route::get('/{id}/view', [CotisationDepenseController::class, 'viewJustificatif'])->name('view');
        });
    });
});

require __DIR__.'/auth.php';