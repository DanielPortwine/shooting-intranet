<?php

use App\Http\Controllers\CheckInDownloadController;
use App\Http\Livewire\CheckInCreate;
use App\Http\Livewire\CompetitionShow;
use App\Http\Livewire\CompetitionsList;
use App\Http\Livewire\FirearmsList;
use App\Http\Livewire\UserApplicationUpdate;
use App\Http\Livewire\VisitShow;
use App\Http\Livewire\VisitsList;
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
    Route::get('/check-in/download', [CheckInDownloadController::class, 'download'])->middleware(config('filament.middleware.auth'))->name('check-in-download');
    Route::get('/check-in/view', function () { return view('pdfs.check-in'); })->middleware(config('filament.middleware.auth'))->name('check-in-view');
    Route::get('/check-in/{token}', CheckInCreate::class)->name('check-in-create');
    Route::get('/visits', VisitsList::class)->name('visits');
    Route::get('/visits/{visitID}', VisitShow::class)->name('visit-show');
    Route::get('/competitions', CompetitionsList::class)->name('competitions');
    Route::get('/competitions/{competitionID}', CompetitionShow::class)->name('competition-show');
    Route::get('/membership', function () { return view('membership'); })->withoutMiddleware('isMember')->name('membership');
    Route::get('/user/application', UserApplicationUpdate::class)->withoutMiddleware('isMember')->name('application-edit');
    Route::get('/user/firearms', FirearmsList::class)->name('firearms');
});
