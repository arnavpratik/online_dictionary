<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $table = 'words'; // Your table name
    protected $fillable = ['word', 'meaning', 'word_length', 'created_at']; // Add all relevant columns
}

