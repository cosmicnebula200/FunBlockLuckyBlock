<?php

declare(strict_types=1);

namespace cosmicnebula200\FunBlockLuckyBlock\listeners;

use cosmicnebula200\FunBlockLuckyBlock\FunBlockLuckyBlock;
use cosmicnebula200\FunBlockLuckyBlock\luckyblock\tile\LuckyBlock;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\nbt\NoSuchTagException;
use pocketmine\scheduler\ClosureTask;

class EventListener implements Listener
{

    /**
     * @param BlockBreakEvent $event
     * @return void
     * @priority MONITOR
     */
    public function onBlockBreak(BlockBreakEvent $event): void
    {
        $block = $event->getBlock();
        $pos = $block->getPosition();
        $tile = $block->getPosition()->getWorld()->getTileAt($pos->getX(), $pos->getY(), $pos->getZ());
        if ($tile instanceof LuckyBlock)
        {
            $level = $tile->getLevel();
            if ($level == 0 or $level > FunBlockLuckyBlock::getInstance()->getLevelManager()->getMaxLevel())
                return;
        }
    }

}