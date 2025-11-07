<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [CompanyController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/view_companies', [CompanyController::class, 'view_companies'])->name('view_companies');
    Route::get('/add_companies', [CompanyController::class, 'add_companies'])->name('add_companies');
    Route::post('/create_companies', [CompanyController::class, 'create_companies'])->name('create_companies');
    Route::get('/edit_companies/{id}', [CompanyController::class, 'edit_companies'])->name('edit_companies');
    Route::post('/update_companies/{id}', [CompanyController::class, 'update_companies'])->name('update_companies');
    Route::delete('/delete_companies/{id}', [CompanyController::class, 'delete_companies'])->name('delete_companies');
});

require __DIR__.'/auth.php';
