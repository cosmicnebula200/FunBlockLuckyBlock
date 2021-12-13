<?php

declare(strict_types=1);

namespace cosmicnebula200\FunBlockLuckyBlock\levels;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;

class Level
{

    /** @var int */
    private int $level;
    /** @var array */
    private array $drops, $blocks, $commands;

    public function __construct(array $drops)
    {
        foreach ($drops as $id => $drop)
        {
            for ($x = 0; $x <= $drop['chance']; $x++)
            {
                // TODO
            }
        }
    }

}
