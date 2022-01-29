<?php

namespace cosmicnebula200\FunBlockLuckyBlock\luckyblock\tile;

use pocketmine\block\tile\Spawnable;
use pocketmine\math\Vector3;
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

    public function setLevel(int $level): void
    {
        $this->level = $level;;
    }

    protected function addAdditionalSpawnData(CompoundTag $nbt): void
    {
        $nbt->setInt('level', $this->getLevel());
    }

    public function readSaveData(CompoundTag $nbt): void
    {
        $this->level = $nbt->getInt('level');
    }

    protected function writeSaveData(CompoundTag $nbt): void
    {
        $nbt->setInt('level', $this->getLevel());
    }

}
