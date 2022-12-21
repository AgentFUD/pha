<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Jobs\ParseRoundJob;

class GameController extends Controller
{
    // Validate all the rows of the file
    // -- Validate all the hands in a row
    // -- Validate all the cards in a hand
    // Upload file
    // Parse uploaded file
    // Save parsed items to database by calling a job
    // Trigger generateStatistics job
    // Create a service for Player hand evaluation, straight, three of a kind, etc.
    // Create a service for hand rankings.
    // -- Calculate best hand for every round, save it to database as winner of that round
    // -- Create statistics related tables, fill them with data on the fly so when 
    //    getPlayerStatistics() gets called only database retrievals should happen
    public function uploadFile(Request $request)
    {
        $file = $request->file('file')->get();
        $lines = explode("\n", $file);
        foreach($lines as $line) {
            ParseRoundJob::dispatch($line);
        }
        return ['ok' => true];
    }

    public function getPlayerStatistics(Request $request, Player $player)
    {
        // Load generated statistics from database
        // Return it to user
    }
}
