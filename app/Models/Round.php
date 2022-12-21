<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hand;

class Round extends Model
{
    use HasFactory;

    protected $fillable = [
        'hand1_id',
        'hand2_id',
    ];

    public function firstHand()
    {
        return $this->hasOne(Hand::class, 'id', 'hand1_id');
    }

    public function secondHand()
    {
        return $this->hasOne(Hand::class, 'id', 'hand2_id');
    }
}
