<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Word;

class DictionaryController extends Controller
{
    public function index(Request $request)
{
    // Handle Word of the Day using Session
    if (!Session::has('word_of_the_day') || Session::get('word_of_the_day_date') !== Carbon::today()->toDateString()) {
        $wordOfTheDay = Word::whereNotNull('meaning')->where('meaning', '!=', '')->inRandomOrder()->first();
        Session::put('word_of_the_day', $wordOfTheDay);
        Session::put('word_of_the_day_date', Carbon::today()->toDateString());
    } else {
        $wordOfTheDay = Session::get('word_of_the_day');
    }

    // Initialize an empty collection for words
    $words = collect();
    $wordDetail = null;
    $message = null;

    // Check if any search input is provided
    if ($request->filled('word') || $request->filled('word_length')) {
        $query = Word::query()->whereNotNull('meaning')->where('meaning', '!=', '');

        if ($request->filled('word')) {
            $query->where('word', 'LIKE', $request->word . '%');
        }

        if ($request->filled('word_length')) {
            $query->where('word_length', (int) $request->word_length);
        }

        $words = $query->get();
        $wordDetail = $request->filled('word_id') ? Word::find($request->word_id) : null;
    } else {
        $message = 'Please enter something to search.';
    }

    return view('dictionary', compact('words', 'wordOfTheDay', 'wordDetail', 'message'));
}

}
