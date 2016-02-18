<?php

namespace _64FF00\XeviousPE_Factions\tribblemaker;

use _64FF00\XeviousPE_Factions\Tribble
    ;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class TribbleMaker
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

    private $trib;

    /**
     * TribbleMaker constructor.
     * @param Tribble $tribble
     */
    public function __construct(Tribble $tribble)
    {
        $this->trib = $tribble;
    }

    public function admin(CommandSender $sender, $args)
    {
        return true;
    }

    public function claim(CommandSender $sender, $args)
    {
        return true;
    }

    public function create(CommandSender $sender, $args)
    {
        if(!$sender->hasPermission("xevpefacs.f.create"))
        {
            $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");

            return true;
        }

        if(!isset($args[1]))
        {
            $sender->sendMessage(TextFormat::YELLOW . "Usage: /f create <name>");

            return true;
        }

        if(!$this->trib->getProvider()->addFaction($args[1]))
        {
            $sender->sendMessage(TextFormat::RED . "[ERROR] That name is already in use.");

            return true;
        }

        $this->trib->getProvider()->addMember($args[1], $sender->getName());
        $this->trib->getProvider()->setPlayerFaction($sender->getName(), $args[1]);

        $sender->sendMessage(TextFormat::DARK_GRAY . "You created the faction successfully.");

        return true;
    }

    public function home(CommandSender $sender, $args)
    {
        return true;
    }

    public function info(CommandSender $sender, $args)
    {
        return true;
    }

    public function invite(CommandSender $sender, $args)
    {
        return true;
    }

    public function join(CommandSender $sender, $args)
    {
        return true;
    }

    public function leave(CommandSender $sender, $args)
    {
        return true;
    }

    public function motd(CommandSender $sender, $args)
    {
        if(!$sender->hasPermission("xevpefacs.f.motd"))
        {
            $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");

            return true;
        }

        if(!isset($args[1]))
        {
            $sender->sendMessage(TextFormat::YELLOW . "Usage: /f motd <motd>");

            return true;
        }

        $faction = $this->trib->getProvider()->getPlayerFaction($sender->getName());

        if(empty($faction))
        {
            $sender->sendMessage(TextFormat::RED . "[ERROR] You don't belong to any faction.");

            return true;
        }

        if(!$this->trib->getProvider()->setMotd($faction, $args[1]))
        {
            $sender->sendMessage(TextFormat::RED . "[ERROR] Invalid MOTD!");

            return true;
        }

        $sender->sendMessage(TextFormat::DARK_GRAY . "You set your faction MOTD to '" . $args[1] . "'");
    }

    public function myFac(CommandSender $sender, $args)
    {
        $faction = $this->trib->getProvider()->getPlayerFaction($sender->getName());

        if(empty($faction))
        {
            $sender->sendMessage(TextFormat::DARK_GRAY . "You don't belong to any faction.");

            return true;
        }

        // TODO: ADD MORE INFO
        $sender->sendMessage(TextFormat::DARK_GRAY . "Your faction: " . $faction);
    }

    public function remove(CommandSender $sender, $args)
    {
        if(!$sender->hasPermission("xevpefacs.f.remove"))
        {
            $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");

            return true;
        }

        if(!isset($args[1]))
        {
            $sender->sendMessage(TextFormat::RED . "Usage: /f remove <name>");

            return true;
        }

        if(!$this->trib->getProvider()->removeFaction($args[1]))
        {
            $sender->sendMessage(TextFormat::RED . "[ERROR] Faction " . $args[1] . " does NOT exist.");

            return true;
        }

        $this->trib->getProvider()->removeMember($args[1], $sender->getName());
        $this->trib->getProvider()->setPlayerFaction($sender->getName(), null);

        $sender->sendMessage(TextFormat::DARK_GRAY . "You disbanded your faction.");
    }

    public function setHome(CommandSender $sender, $args)
    {
        return true;
    }

    public function setRank(CommandSender $sender, $args)
    {
        return true;
    }

    public function unclaim(CommandSender $sender, $args)
    {
        return true;
    }
}
