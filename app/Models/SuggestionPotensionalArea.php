<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionPotensionalArea extends Model
{
    use HasFactory;

    protected $table = 'potentional_area_suggestion';

    protected $fillable = [
        'id',
        'name',
        'suggestion',
    ];
}
