<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Player;

class Hand extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'card1',
        'card2',
        'card3',
        'card4',
        'card5'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class)->withDefault();
    }
}
