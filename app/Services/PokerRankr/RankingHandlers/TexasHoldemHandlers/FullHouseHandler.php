<?php declare(strict_types=1);

namespace App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers;

use App\Services\PokerRankr\Entities\PokerHand;
use App\Services\PokerRankr\Interfaces\RankingHandlerInterface;
use App\Services\PokerRankr\PokerRanking;
use App\Services\PokerRankr\RankingHandlers\RankingHandlerTrait;

/**
 * Class FullHouseHandler
 *
 * @package App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers
 */
class FullHouseHandler implements RankingHandlerInterface
{
    use RankingHandlerTrait;
    use TexasHoldemHelperTrait;

    /**
     * @inheritDoc
     */
    public function handle(PokerHand $hand): PokerRanking
    {
        $ranks = $this->extractRanks($hand);

        // Count occurrences for each rank value
        $occurrences = array_count_values($ranks);

        // Test for 3 of a kind and a pair
        if (!(in_array(3, $occurrences, false) && in_array(2, $occurrences, false))) {
            return $this->next($hand);
        }

        $rankingValue   = PokerRanking::FULL_HOUSE;
        $mainCardsValue = array_search(3, $occurrences, false);
        $kickerOneValue = array_search(2, $occurrences, false);

        return new PokerRanking($rankingValue, $mainCardsValue, $kickerOneValue);
    }
}