<?php declare(strict_types=1);

namespace App\Services\PokerRankr\Entities;

use Ds\Set;
use App\Services\PokerRankr\Interfaces\CollectionInterface;
use App\Services\PokerRankr\Interfaces\EntityInterface;
use App\Services\PokerRankr\PokerRanking;

/**
 * Class PokerHand
 *
 * A PokerHand has some collection traits, but it's not really
 * a collection, so there is no collection abstract parent.
 *
 * @method  \ArrayIterator|PokerCard[] getIterator()
 * @package App\Services\PokerRankr\Entities
 */
class PokerHand implements CollectionInterface, EntityInterface, \IteratorAggregate
{
    use CollectionTrait;

    /**
     * @var null|PokerRanking The ranking of the hand.
     */
    protected $ranking;

    /**
     * PokerHand constructor.
     *
     * @param PokerCard ...$cards
     */
    public function __construct(PokerCard ...$cards)
    {
        $this->values = new Set(...[$cards]);
    }

    /**
     * Instantiates a new PokerHand from an array.
     *
     * @param array $cards
     *
     * @return  PokerHand
     */
    public static function fromArray(array $cards): PokerHand
    {
        return new self(...array_map(function ($card) {
            return PokerCard::fromArray($card);
        }, $cards));
    }

    /**
     * Returns the hand's poker ranking if the hand has been previously evaluated.
     *
     * @return PokerRanking|null
     */
    public function getRanking(): ?PokerRanking
    {
        return $this->ranking;
    }

    /**
     * Attaches a poker ranking to the hand.
     *
     * @param PokerRanking|null $ranking
     */
    public function setRanking(?PokerRanking $ranking): void
    {
        $this->ranking = $ranking;
    }
}
