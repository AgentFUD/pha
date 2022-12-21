<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Hand;
use App\Models\Player;
use App\Models\Round;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ParseRoundJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $allHands = ['2D','2C','2S','2H','3D','3C','3S','3H','4D','4C','4S','4H','5D','5C','5S','5H','6D','6C','6S','6H','7D','7C','7S','7H','8D','8C','8S','8H','9D','9C','9S','9H','TD','TC','TS','TH','JD','JC','JS','JH','QD','QC','QS','QH','KD','KC','KS','KH','AD','AC','AS','AH'];
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public string $line)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cards = explode(" ", $this->line);
        
        Validator::make($cards, [Rule::in($this->allHands)])->validate();

        $player1_hand = array_slice($cards, 0, 5);
        $player2_hand = array_slice($cards, 5, 5);

        $player1 = Player::find(1);
        $player2 = Player::find(2);

        $hand1 = Hand::create([
            'player_id' => $player1->id,
            'card1' => $player1_hand[0],
            'card2' => $player1_hand[1],
            'card3' => $player1_hand[2],
            'card4' => $player1_hand[3],
            'card5' => $player1_hand[4],
        ]);

        $hand2 = Hand::create([
            'player_id' => $player2->id,
            'card1' => $player2_hand[0],
            'card2' => $player2_hand[1],
            'card3' => $player2_hand[2],
            'card4' => $player2_hand[3],
            'card5' => $player2_hand[4],
        ]);

        Round::create([
            'hand1_id' => $hand1->id,
            'hand2_id' => $hand2->id,
        ]);
    }
}
