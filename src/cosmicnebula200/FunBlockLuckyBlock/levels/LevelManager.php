<?php

declare(strict_types=1);

namespace cosmicnebula200\FunBlockLuckyBlock\levels;

class LevelManager
{

    /** @var Level[]  */
    private array $levels;

    public function __construct()
    {
        // TODO
    }

    public function getMaxLevel(): int
    {
        return count($this->levels);
    }

}
