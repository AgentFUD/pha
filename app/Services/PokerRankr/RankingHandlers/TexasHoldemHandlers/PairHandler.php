<?php declare(strict_types=1);

namespace App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers;

use App\Services\PokerRankr\Entities\PokerHand;
use App\Services\PokerRankr\Interfaces\RankingHandlerInterface;
use App\Services\PokerRankr\PokerRanking;
use App\Services\PokerRankr\RankingHandlers\RankingHandlerTrait;

/**
 * Class PairHandler
 *
 * @package App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers
 */
class PairHandler implements RankingHandlerInterface
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

        if (!in_array(2, $occurrences, false)) {
            return $this->next($hand);
        }

        $rankingValue   = PokerRanking::PAIR;
        $mainCardsValue = array_search(2, $occurrences, false);

        for ($i = 1; $i <= 2; $i++) {
            // Remove pairs from the cards and leave only kickers
            $index = array_search($mainCardsValue, $ranks, false);
            unset($ranks[$index]);
        }

        // Reset array keys
        $ranks = array_values($ranks);

        rsort($ranks);

        return new PokerRanking($rankingValue, $mainCardsValue, ...$ranks);
    }
}