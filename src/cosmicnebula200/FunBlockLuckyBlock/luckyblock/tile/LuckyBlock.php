<?php

namespace cosmicnebula200\FunBlockLuckyBlock\luckyblock\tile;

use pocketmine\block\tile\Spawnable;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\nbt\NoSuchTagException;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\world\World;

class LuckyBlock extends Spawnable
{

    /** @var int  */
    private int $level;

    public function __construct(World $world, Vector3 $pos, int $level = 0)
    {
        $this->level = $level;
        parent::__construct($world, $pos);
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    public function copyDataFromItem(Item $item): void
    {
        parent::copyDataFromItem($item);
        try {
            $nbt = $item->getNamedTag()->getString('funblockluckyblock');
        } catch (NoSuchTagException) {
            $nbt = false;
        }
        if ($nbt !== 'true')
            return;
        try {
            $level = $item->getNamedTag()->getTag('level');
        } catch (NoSuchTagException) {
            $level = 0;
        }
    }

    /**
     * @param int $level
     * @return void
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;;
    }

    /**
     * @param CompoundTag $nbt
     * @return void
     */
    protected function addAdditionalSpawnData(CompoundTag $nbt): void
    {
        $nbt->setInt('level', $this->getLevel());
    }

    /**
     * @param CompoundTag $nbt
     * @return void
     */
    public function readSaveData(CompoundTag $nbt): void
    {
        $this->level = $nbt->getInt('level');
    }

    /**
     * @param CompoundTag $nbt
     * @return void
     */
    protected function writeSaveData(CompoundTag $nbt): void
    {
        $nbt->setInt('level', $this->getLevel());
    }

}
