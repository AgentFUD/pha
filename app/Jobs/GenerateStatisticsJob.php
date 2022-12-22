<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Round;
use App\Services\PokerRankr\Entities\PokerHand;
use App\Services\PokerRankr\Entities\PokerCard;
use App\Services\PokerRankr\Facades\PokerRankr as PokerRankrFacade;
use App\Services\PokerRankr\PokerRanking;


class GenerateStatisticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
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
        foreach(Round::all() as $round) {
            $firstHand = $round->firstHand()->first();
            $secondHand = $round->secondHand()->first();

            /**
             * First hand ranking
             */
            $hand = new PokerHand();
            $card = $firstHand->card1;
            $rs = $this->getCardRankAndSuit($card);
            $hand->add(new PokerCard($rs[0], $rs[1]));

            $card = $firstHand->card2;
            $rs = $this->getCardRankAndSuit($card);
            $hand->add(new PokerCard($rs[0], $rs[1]));

            $card = $firstHand->card3;
            $rs = $this->getCardRankAndSuit($card);
            $hand->add(new PokerCard($rs[0], $rs[1]));

            $card = $firstHand->card4;
            $rs = $this->getCardRankAndSuit($card);
            $hand->add(new PokerCard($rs[0], $rs[1]));

            $card = $firstHand->card5;
            $rs = $this->getCardRankAndSuit($card);
            $hand->add(new PokerCard($rs[0], $rs[1]));
    
            $firstHandRanking = PokerRankrFacade::evaluateHand($hand);
            

            /**
             * Second hand ranking
             */
            $hand = new PokerHand();
            $card = $secondHand->card1;
            $rs = $this->getCardRankAndSuit($card);
            $hand->add(new PokerCard($rs[0], $rs[1]));

            $card = $secondHand->card2;
            $rs = $this->getCardRankAndSuit($card);
            $hand->add(new PokerCard($rs[0], $rs[1]));

            $card = $secondHand->card3;
            $rs = $this->getCardRankAndSuit($card);
            $hand->add(new PokerCard($rs[0], $rs[1]));

            $card = $secondHand->card4;
            $rs = $this->getCardRankAndSuit($card);
            $hand->add(new PokerCard($rs[0], $rs[1]));

            $card = $secondHand->card5;
            $rs = $this->getCardRankAndSuit($card);
            $hand->add(new PokerCard($rs[0], $rs[1]));
    
            $secondHandRanking = PokerRankrFacade::evaluateHand($hand);
            print($firstHandRanking->getValue() ."-". $secondHandRanking->getValue()."\n");
            if($firstHandRanking->beats($secondHandRanking)) {
                print("Winner is 1\n");
            } else {
                print("Winner is 2\n");
            }
        }
    }

    public function getCardRankAndSuit($card)
    {
        $rankString = $card[0];
        $rank = (int)$rankString;
        if($rank == 0) {
            if($rankString == 'T') $rank = PokerCard::RANK_TEN;
            if($rankString == 'J') $rank = PokerCard::RANK_JACK;
            if($rankString == 'Q') $rank = PokerCard::RANK_QUEEN;
            if($rankString == 'K') $rank = PokerCard::RANK_KING;
            if($rankString == 'A') $rank = PokerCard::RANK_ACE;
        }

        $suitString = $card[1];
        if($suitString == "C") $suit = PokerCard::SUIT_CLUBS;
        if($suitString == "D") $suit = PokerCard::SUIT_DIAMONDS;
        if($suitString == "H") $suit = PokerCard::SUIT_HEARTS;
        if($suitString == "S") $suit = PokerCard::SUIT_SPADES;

        return [$rank, $suit];
    }
}
