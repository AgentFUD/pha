<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoundStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'round_id',
        'first_hand_ranking',
        'second_hand_ranking',
        'winner_id',
    ];
}
