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

class ParseRoundJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
