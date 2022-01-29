<?php

declare(strict_types=1);

namespace cosmicnebula200\FunBlockLuckyBlock;

use CortexPE\Commando\PacketHooker;
use cosmicnebula200\FunBlockLuckyBlock\commands\LuckyBlockCommand;
use cosmicnebula200\FunBlockLuckyBlock\levels\LevelManager;
use cosmicnebula200\FunBlockLuckyBlock\listeners\EventListener;
use cosmicnebula200\FunBlockLuckyBlock\luckyblock\LuckyBlock;
use cosmicnebula200\FunBlockLuckyBlock\luckyblock\tile\LuckyBlock as LuckyBlockTile;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockFactory;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockLegacyIds;
use pocketmine\block\BlockToolType;
use pocketmine\block\tile\TileFactory;
use pocketmine\item\ItemIds;
use pocketmine\plugin\PluginBase;

class FunBlockLuckyBlock extends PluginBase
{

    /** @var self */
    private static self $instance;
    /** @var LevelManager */
    private LevelManager $levelManager;

    public function onLoad(): void
    {
        self::$instance = $this;
    }

    public function onEnable(): void
    {
        if (!PacketHooker::isRegistered())
            PacketHooker::register($this);

        $this->saveDefaultConfig();
        $this->saveResource('luckyblock.yml');

        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
        $this->getServer()->getCommandMap()->register('FunBlockOneBlock', new LuckyBlockCommand($this, 'luckyblock', 'default command of FunBlockLuckyBlock to give LuckyBlocks'));

        $this->levelManager = new LevelManager();

        BlockFactory::getInstance()->register(new LuckyBlock(new BlockIdentifier($this->getConfig()->getNested('luckyblock.block-id', BlockLegacyIds::NETHER_REACTOR), 0, $this->getConfig()->getNested('luckyblock.item-id', ItemIds::NETHER_REACTOR), LuckyBlockTile::class), 'LuckyBlock', new BlockBreakInfo($this->getConfig()->getNested('luckyblock.hardness', 5), BlockToolType::PICKAXE)), true);
        TileFactory::getInstance()->register(LuckyBlockTile::class, ['funblockluckyblock']);
    }

    public function getLevelManager(): LevelManager
    {
        return $this->levelManager;
    }

    /**
     * @return FunBlockLuckyBlock
     */
    public static function getInstance(): FunBlockLuckyBlock
    {
        return self::$instance;
    }

}