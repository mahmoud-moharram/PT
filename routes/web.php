<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/ddddddddd', function () {
    return 1;
    (new \App\Jobs\NmapCurl('http://scanme.nmap.org',56,'subdomains','amass'))->dispatch();

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('pt')->middleware('auth')->name('pt.')->group(function (){
    Route::get('/settings',App\Http\Livewire\Settings\Index::class)->name('settings');
    Route::get('/scan/all',App\Http\Livewire\Scan\Index::class)->name('scan.all');
    Route::get('/nmap',App\Http\Livewire\Nmap\Index::class)->name('nmap');
    Route::get('/nmap/show/{id}',App\Http\Livewire\Nmap\Show::class)->name('nmap.show');
    Route::get('/sqlmap',App\Http\Livewire\Sqlmap\Index::class)->name('sqlmap');
    Route::get('/sqlmap/show/{id}',App\Http\Livewire\Sqlmap\Show::class)->name('sqlmap.show');
    Route::get('/subdomains',App\Http\Livewire\Subdomain\Index::class)->name('subdomains');
    Route::get('/subdomains/show/{id}',App\Http\Livewire\Subdomain\Show::class)->name('subdomains.show');
    Route::get('/wpscan',App\Http\Livewire\Wpscan\Index::class)->name('wpscan');
    Route::get('/wpscan/show/{id}',App\Http\Livewire\Wpscan\Show::class)->name('wpscan.show');
});
