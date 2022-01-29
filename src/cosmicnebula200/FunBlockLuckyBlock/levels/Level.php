<?php

declare(strict_types=1);

namespace cosmicnebula200\FunBlockLuckyBlock\levels;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;

class Level
{

    /** @var array */
    private array $drops, $blocks, $commands;

    public function __construct(array $drops, array $blocks, array $commands)
    {
    }

}
