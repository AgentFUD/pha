<?php declare(strict_types=1);

namespace App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers;

use App\Services\PokerRankr\Entities\PokerHand;
use App\Services\PokerRankr\Interfaces\RankingHandlerInterface;
use App\Services\PokerRankr\PokerRanking;
use App\Services\PokerRankr\RankingHandlers\RankingHandlerTrait;

/**
 * Class TwoPairsHandler
 *
 * @package App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers
 */
class TwoPairsHandler implements RankingHandlerInterface
{
    use RankingHandlerTrait;
    use TexasHoldemHelperTrait;

    /**
     * @inheritDoc
     */
    public function handle(PokerHand $hand): PokerRanking
    {
        $ranks = $this->extractRanks($hand);

        // In case of two pairs a hand will have exactly 3 unique ranks
        $uniqueRanks = array_unique($ranks);

        // With 2 pairs among five cards there are 3 unique ranks
        if (count($uniqueRanks) !== 3) {
            return $this->next($hand);
        }

        // Count occurrences for each rank value
        $occurrences = array_count_values($ranks);

        $rankingValue = PokerRanking::TWO_PAIRS;

        $pairsRanks = [];

        foreach ($occurrences as $rank => $occurrence) {
            if ($occurrence === 2) {
                $pairsRanks[] = $rank;
            } else {
                $kickerTwoValue = $rank;
            }
        }

        rsort($pairsRanks);

        // Use the bigger pair as main value and the smaller pair as the first kicker
        [$mainCardsValue, $kickerOneValue] = $pairsRanks;

        return new PokerRanking($rankingValue, $mainCardsValue, $kickerOneValue, $kickerTwoValue);
    }
}