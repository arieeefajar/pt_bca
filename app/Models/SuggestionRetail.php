<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionRetail extends Model
{
    use HasFactory;

    protected $table = 'retail_suggestion';

    protected $fillable = [
        'id',
        'name',
        'suggestion',
    ];
}
