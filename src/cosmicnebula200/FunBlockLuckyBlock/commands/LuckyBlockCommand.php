<?php

namespace cosmicnebula200\FunBlockLuckyBlock\commands;

use CortexPE\Commando\args\IntegerArgument;
use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseCommand;
use cosmicnebula200\FunBlockLuckyBlock\FunBlockLuckyBlock;
use cosmicnebula200\FunBlockLuckyBlock\levels\Level;
use pocketmine\command\CommandSender;
use pocketmine\item\ItemFactory;
use pocketmine\player\Player;

class LuckyBlockCommand extends BaseCommand
{

    protected function prepare(): void
    {
        $this->setPermission('funblockluckyblock.command');
        $this->registerArgument(0, new IntegerArgument('count', true));
        $this->registerArgument(1, new IntegerArgument('level', true));
        $this->registerArgument(2, new RawStringArgument('player', true));
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        $count = 1;
        if (isset($args['count']))
            $count = $args['count'];
        $level = 1;
        if (isset($args['level']))
            $level = $args['level'];
        $player = $sender;
        if (isset($args['player']))
            $player = FunBlockLuckyBlock::getInstance()->getServer()->getPlayerByPrefix($args['player']);
        if (!$player instanceof Player) {
            $sender->sendMessage('Not a valid Player');
            return;
        }
        if (!FunBlockLuckyBlock::getInstance()->getLevelManager()->getLevel($level) instanceof Level) {
            $sender->sendMessage('Not a valid level');
            return;
        }
        $item = ItemFactory::getInstance()->get(FunBlockLuckyBlock::getInstance()->getConfig()->getNested('luckyblock.item-id'));
        $item->getNamedTag()->setString('funblockluckyblock', 'true');
        $item->getNamedTag()->setInt('level', $level);
        $item->setCount($count);
        $player->getInventory()->addItem($item);
    }

}
