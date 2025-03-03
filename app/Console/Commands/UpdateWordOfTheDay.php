<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Word;

class UpdateWordOfTheDay extends Command
{
    protected $signature = 'word:daily';
    protected $description = 'Update the word of the day';

    public function handle()
    {
        $word = Word::where('meaning', '!=', '')->inRandomOrder()->first();
        cache()->put('word_of_the_day', $word, now()->endOfDay());
        $this->info('Word of the Day updated!');
    }
}

