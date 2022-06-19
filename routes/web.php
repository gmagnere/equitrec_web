<?php

use App\Http\Controllers\JudgeController;
use App\Http\Controllers\RiderController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {return Inertia::render('Dashboard');})->name('dashboard');
    Route::get('/rider', [RiderController::class, 'index'])->name('rider.index');
    Route::post('/rider/add', [RiderController::class, 'submit'])->name('rider.add');
    Route::post('/rider/delete', [RiderController::class, 'delete'])->name('rider.delete');
    Route::get('/judge', [JudgeController::class, 'index'])->name('judge.index');
    Route::post('/judge/add', [JudgeController::class, 'submit'])->name('judge.add');
    Route::post('/judge/delete', [JudgeController::class, 'delete'])->name('judge.delete');

});
