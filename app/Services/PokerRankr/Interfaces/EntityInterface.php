<?php declare(strict_types=1);

namespace App\Services\PokerRankr\Interfaces;

/**
 * Interface EntityInterface
 *
 * @package App\Services\PokerRankr\Contracts
 */
interface EntityInterface
{
    /**
     * Converts PokerCard to an array.
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Instantiates a new EntityInterface from an array.
     *
     * @param array $data
     * @return EntityInterface
     */
    public static function fromArray(array $data);
}
