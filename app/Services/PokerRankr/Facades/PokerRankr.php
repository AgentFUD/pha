<?php declare(strict_types=1);

namespace App\Services\PokerRankr\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\PokerRankr\Entities\PokerHand;
use App\Services\PokerRankr\Entities\PokerHandCollection;
use App\Services\PokerRankr\PokerRanking;

/**
 * Class PokerRankr
 *
 * @method static PokerRanking evaluateHand(PokerHand $hand) Returns a hand's ranking as well as attaches it to the hand behind the scenes.
 * @method static PokerHandCollection sortHands(PokerHandCollection $hands) Sorts hands in a collection according to their rankings (strongest to weakest).
 *
 * @package App\Services\PokerRankr\Facades
 */
class PokerRankr extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'PokerRankr';
    }
}
