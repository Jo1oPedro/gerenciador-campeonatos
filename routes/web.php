<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Jogadores;
use App\Http\Livewire\Times;
use App\Http\Livewire\Campeonatos;
use App\Http\Livewire\DashboardCampeonatos;
use App\Http\Livewire\DashboardTimes;

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
    return view('welcome');
});

Route::get('/jogadores', Jogadores::class);

Route::get('/times', Times::class);

Route::get('/campeonatos', Campeonatos::class);

Route::get('/dashboardCampeonatos', DashboardCampeonatos::class);

Route::get('/dashboardTimes', DashboardTimes::class);