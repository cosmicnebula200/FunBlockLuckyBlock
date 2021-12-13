<?php

declare(strict_types=1);

namespace cosmicnebula200\FunBlockLuckyBlock;

use cosmicnebula200\FunBlockLuckyBlock\levels\LevelManager;
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
        $this->saveDefaultConfig();
        $this->saveResource('luckyblock.yml');
        $this->levelManager = new LevelManager();
    }

    /**
     * @return FunBlockLuckyBlock
     */
    public static function getInstance(): FunBlockLuckyBlock
    {
        return self::$instance;
    }

}