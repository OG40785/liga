<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* teams routes */
Route::get('/teams/listTeams', [App\Http\Controllers\TeamController::class, 'list']);

Route::get('/teams/delete/{id}', [App\Http\Controllers\TeamController::class, 'showDeleteTeamPage']);
Route::get('/teams/deleteTeam/{id}', [App\Http\Controllers\TeamController::class, 'deleteTeam']);
Route::get('/teams/edit/{id}', [App\Http\Controllers\TeamController::class, 'showEditTeamPage']);
/* players routes */

Route::get('/players/listPlayers', [App\Http\Controllers\PlayerController::class, 'list']);
Route::get('/players/deleteFromTeam/{id}/{teamId}', [App\Http\Controllers\PlayerController::class, 'deleteFromTeam']);//no funciona
