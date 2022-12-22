<?php declare(strict_types=1);

namespace App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers;

use App\Services\PokerRankr\Entities\PokerCard;
use App\Services\PokerRankr\Entities\PokerHand;
use App\Services\PokerRankr\Interfaces\RankingHandlerInterface;
use App\Services\PokerRankr\PokerRanking;
use App\Services\PokerRankr\RankingHandlers\RankingHandlerTrait;

/**
 * Class StraightFlushHandler
 *
 * @package App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers
 */
class StraightFlushHandler implements RankingHandlerInterface
{
    use RankingHandlerTrait;
    use TexasHoldemHelperTrait;

    /**
     * @inheritDoc
     */
    public function handle(PokerHand $hand): PokerRanking
    {
        $suits = $this->extractSuits($hand);

        // Count occurrences for each suit value
        $occurrences = array_count_values($suits);

        // Check if all 5 cards are of the same suit
        if (!in_array(5, $occurrences, false)) {
            return $this->next($hand);
        }

        $ranks = $this->extractRanks($hand);

        $ranksConsecutive = $this->checkConsecutiveRanks($ranks);

        if (!$ranksConsecutive) {
            // Check for a straight starting with Ace
            if (!in_array(PokerCard::RANK_ACE, $ranks, false)) {
                return $this->next($hand);
            }

            $aceKey = array_search(PokerCard::RANK_ACE, $ranks, false);

            $ranks[$aceKey] = PokerCard::RANK_LOWER_ACE;

            $ranksConsecutive = $this->checkConsecutiveRanks($ranks);

            if (!$ranksConsecutive) {
                return $this->next($hand);
            }
        }

        $rankingValue   = PokerRanking::STRAIGHT_FLUSH;
        $mainCardsValue = array_sum($ranks);

        return new PokerRanking($rankingValue, $mainCardsValue);
    }
}