<?php

use App\Http\Controllers\PersonalityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PersonalityController::class, 'index'])->name('personality.index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',
        [
            'sheetCount' => \App\Models\Personality::all()->count(),
            'distinctContributors' => \App\Models\Personality::all()->unique('user_id')->count(),
            'sheetWrittenCount' => \App\Models\Personality::all()->where('user_id', auth()->id())->count(),
        ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Grouped routes with prefix 'personality' and name 'personality.'.
    Route::prefix('personality')->name('personality.')->group(function () {
        Route::get('/create', [PersonalityController::class, 'create'])->name('create');
        Route::post('/', [PersonalityController::class, 'store'])->name('store');
        Route::get('/{personality}/edit', [PersonalityController::class, 'edit'])->name('edit');
        Route::patch('/{personality}', [PersonalityController::class, 'update'])->name('update');
        Route::delete('/{personality}', [PersonalityController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';





