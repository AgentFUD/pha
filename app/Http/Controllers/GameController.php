<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class GameController extends Controller
{
    public function uploadFile(Request $request)
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
    }

    public function getPlayerStatistics(Request $request, Player $player)
    {
        // Load generated statistics from database
        // Return it to user
    }
}
