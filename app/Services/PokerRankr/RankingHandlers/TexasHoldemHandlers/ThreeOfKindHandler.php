<?php declare(strict_types=1);

namespace App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers;

use App\Services\PokerRankr\Entities\PokerHand;
use App\Services\PokerRankr\Interfaces\RankingHandlerInterface;
use App\Services\PokerRankr\PokerRanking;
use App\Services\PokerRankr\RankingHandlers\RankingHandlerTrait;

/**
 * Class ThreeOfKindHandler
 * @package App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers
 */
class ThreeOfKindHandler implements RankingHandlerInterface
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

        // Test for 3 cards of the same rank
        if (!in_array(3, $occurrences, false)) {
            return $this->next($hand);
        }

        $rankingValue   = PokerRanking::THREE_OF_KIND;
        $mainCardsValue = array_search(3, $occurrences, false);

        for ($i = 1; $i <= 3; $i++) {
            // Remove the cards of the triplet and leave only kickers
            $index = array_search($mainCardsValue, $ranks);
            unset($ranks[$index]);
        }

        // Reset array keys
        $ranks = array_values($ranks);

        rsort($ranks);

        return new PokerRanking($rankingValue, $mainCardsValue, ...$ranks);
    }
}