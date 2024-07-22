<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/pokemon', [PokemonController::class, 'index'])->name('pokemon.index');
Route::get('/pokemon/{name}', [PokemonController::class, 'show'])->name('pokemon.show');
Route::get('/pokemon/random', [PokemonController::class, 'random'])->name('pokemon.random');
