<?php

namespace _64FF00\XeviousPE_Factions;

use _64FF00\XeviousPE_Factions\tribblemaker\TribbleMaker;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;

use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\TextFormat;

class KerryGoesShopping implements CommandExecutor
{
    /*
        XeviousPE-Factions by 64FF00 (Twitter: @64FF00) / xeviousnetwork.ca

          888  888    .d8888b.      d8888  8888888888 8888888888 .d8888b.   .d8888b.
          888  888   d88P  Y88b    d8P888  888        888       d88P  Y88b d88P  Y88b
        888888888888 888          d8P 888  888        888       888    888 888    888
          888  888   888d888b.   d8P  888  8888888    8888888   888    888 888    888
          888  888   888P "Y88b d88   888  888        888       888    888 888    888
        888888888888 888    888 8888888888 888        888       888    888 888    888
          888  888   Y88b  d88P       888  888        888       Y88b  d88P Y88b  d88P
          888  888    "Y8888P"        888  888        888        "Y8888P"   "Y8888P"
    */

    private $trib, $tribbleMaker;

    /**
     * KerryGoesShopping constructor.
     * @param Tribble $tribble
     */
    public function __construct(Tribble $tribble)
    {
        $this->trib = $tribble;

        $this->tribbleMaker = new TribbleMaker($tribble);
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args)
    {
        if($sender instanceof ConsoleCommandSender)
        {
            $sender->sendMessage(TextFormat::RED . "[ERROR] This command cannot be run on console.");

            return true;
        }

        if(!isset($args[0]))
        {
            $sender->sendMessage(TextFormat::YELLOW . "--- XeviousPE-Factions by 64FF00 ---");
            $sender->sendMessage(TextFormat::YELLOW . "Usage: /f <admin / claim / create / home / invite / join / leave / motd / remove / sethome / setrank / unclaim>");

            return true;
        }

        switch(strtolower($args[0]))
        {
            case "admin":

                return $this->tribbleMaker->admin($sender, $args);

            case "claim":

                return $this->tribbleMaker->claim($sender, $args);

            case "create":

                return $this->tribbleMaker->create($sender, $args);

            case "home":

                return $this->tribbleMaker->home($sender, $args);

            case "invite":

                return $this->tribbleMaker->invite($sender, $args);

            case "join":

                return $this->tribbleMaker->join($sender, $args);

            case "leave":

                return $this->tribbleMaker->leave($sender, $args);

            case "motd":

                return $this->tribbleMaker->motd($sender, $args);

            case "myfac":

                return $this->tribbleMaker->myFac($sender, $args);

            case "remove":

                return $this->tribbleMaker->remove($sender, $args);

            case "sethome":

                return $this->tribbleMaker->setHome($sender, $args);

            case "setrank":

                return $this->tribbleMaker->setRank($sender, $args);

            case "unclaim":

                return $this->tribbleMaker->unclaim($sender, $args);

            default:

                return $this->tribbleMaker->info($sender, $args);
        }
    }
}
