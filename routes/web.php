<?php

use Illuminate\Support\Facades\Route;

use App\Models\Word;
use App\Http\Controllers\DictionaryController;

Route::get('/', function () {
    $wordOfTheDay = Word::where('meaning', '!=', '')->inRandomOrder()->first();
    return view('home', compact('wordOfTheDay'));
});


Route::get('/', [DictionaryController::class, 'index'])->name('dictionary');

