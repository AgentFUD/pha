<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Hand;

class HandFactory extends Factory
{
    protected $model = Hand::class;

    protected $allHands = ['2D','2C','2S','2H','3D','3C','3S','3H','4D','4C','4S','4H','5D','5C','5S','5H','6D','6C','6S','6H','7D','7C','7S','7H','8D','8C','8S','8H','9D','9C','9S','9H','TD','TC','TS','TH','JD','JC','JS','JH','QD','QC','QS','QH','KD','KC','KS','KH','AD','AC','AS','AH'];
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hands = array_rand($this->allHands, 5);

        return [
            'player_id' => $this->faker->name(),
            'card1' => $this->allHands[$hands[0]],
            'card2' => $this->allHands[$hands[1]],
            'card3' => $this->allHands[$hands[2]],
            'card4' => $this->allHands[$hands[3]],
            'card5' => $this->allHands[$hands[4]],
        ];
    }
}
