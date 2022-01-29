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

    /**
     * @param BlockPlaceEvent $event
     * @return void
     * @priority MONITOR
     */
    public function onPlace(BlockPlaceEvent $event): void
    {
        $item = $event->getItem();
        $block = $event->getBlock();
        $world = $event->getPlayer()->getWorld();
        try {
            $level = $item->getNamedTag()->getInt('level');
        } catch (NoSuchTagException) {
            return;
        }
        FunBlockLuckyBlock::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use($world, $block, $level):void {
            $tile = $world->getTile($block->getPosition());
            if ($tile instanceof LuckyBlock)
                $tile->setLevel($level);
        }), 1);
    }

}