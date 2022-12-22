<?php declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | PokerRankr Ranking Handlers definition
    |--------------------------------------------------------------------------
    |
    */
    'default' => 'texas-holdem',

    'texas-holdem' => [
        // Order is not to be changed

        \App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers\RoyalFlushHandler::class,
        \App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers\StraightFlushHandler::class,
        \App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers\FourOfKindHandler::class,
        \App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers\FullHouseHandler::class,
        \App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers\FlushHandler::class,
        \App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers\StraightHandler::class,
        \App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers\ThreeOfKindHandler::class,
        \App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers\TwoPairsHandler::class,
        \App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers\PairHandler::class,
        \App\Services\PokerRankr\RankingHandlers\TexasHoldemHandlers\HighCardHandler::class,
    ]

];
