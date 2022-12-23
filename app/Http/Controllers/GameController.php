<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ParseRoundJob;
use App\Jobs\GenerateStatisticsJob;
use App\Models\RoundStatistics;

class GameController extends Controller
{
    public function uploadFile(Request $request)
    {
        $file = $request->file('file')->get();
        $lines = explode("\n", $file);
        foreach($lines as $line) {
            ParseRoundJob::dispatch($line);
        }
        return ['message' => 'OK'];
    }

    public function calculateStatistics(Request $request)
    {
        GenerateStatisticsJob::dispatch();
        return ['message' => 'OK'];
    }

    public function getStatistics(Request $request)
    {
        $player1_wins = RoundStatistics::where('winner_id', 1)->count();
        $player2_wins = RoundStatistics::where('winner_id', 2)->count();
        $total_rounds = RoundStatistics::count();
        $player1_best_hand = RoundStatistics::where('winner_id', 1)->max('first_hand_ranking');
        $player2_best_hand = RoundStatistics::where('winner_id', 2)->max('second_hand_ranking');
        
        return [
            'Total rounds' => $total_rounds,
            'Player1 number of wins' => $player1_wins,
            'Player 1 best hand' => $player1_best_hand,
            'Player2 number of wins' => $player2_wins,
            'Player 2 best hand' => $player2_best_hand,
            'Note' => 'The meaning of the best hand numbers you can find in app/Services/PokerRankr/PokerRanking.php',
            'Message' => 'Merry Xmas and Happy New Year to United Remote',
        ];
    }
}
