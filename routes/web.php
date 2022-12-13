<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\UserApplicationUpdate;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'isMember'])->group(function () {
    Route::get('/', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/membership', function () { return view('membership'); })->withoutMiddleware('isMember')->name('membership');
    Route::get('/user/application', UserApplicationUpdate::class)->withoutMiddleware('isMember')->name('application-edit');
});
