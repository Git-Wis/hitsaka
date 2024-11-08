<?php

use App\Http\Controllers\BilanController;
use App\Http\Controllers\EquipageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResaController;
use App\Http\Controllers\ColisController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //retourné vers espace utulisateur 

    Route::get('/bilan', [BilanController::class, 'show_bilan'])->name('bilan.show');
    Route::post('/reservation/{id}/confirm', [ResaController::class, 'confirm'])->name('resa.confirm');
    Route::resource('equipe', EquipageController::class);
    Route::get('/reservation/{id}', [ResaController::class, 'semaine_resa'])->name('resa.semaine_resa');

    Route::get('reservations/export/excel', [ResaController::class, 'exportExcel'])->name('resa.export.excel');
    Route::get('reservations/export/pdf', [ResaController::class, 'exportPDF'])->name('resa.export.pdf');


});

Route::resource('resa', ResaController::class);
Route::resource('colis', ColisController::class);
Route::get('colis/suivi', [ColisController::class, 'suivi'])->name('colis.suivi');



require __DIR__.'/auth.php';
