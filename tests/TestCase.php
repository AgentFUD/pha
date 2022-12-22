<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use SmaatCoda\PokerRankr\PokerRankrServiceProvider;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getPackageProviders($app)
    {
        return [
            PokerRankrServiceProvider::class
        ];
    }
}
