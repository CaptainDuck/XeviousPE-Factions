<?php

namespace _64FF00\XeviousPE_Factions\persistence;

use _64FF00\XeviousPE_Factions\Tribble;
use pocketmine\utils\Config;

class YAMLProvider implements PointlessProvider
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

    private $factionsDataFolder, $playersDataFolder, $trib;

    /**
     * YAMLProvider constructor.
     * @param Tribble $tribble
     * @_64ff00 TEST PROVIDER
     */
    public function __construct(Tribble $tribble)
    {
        $this->trib = $tribble;

        $this->factionsDataFolder = $this->trib->getDataFolder() . "factions/";
        $this->playersDataFolder = $this->trib->getDataFolder() . "players/";

        if(!file_exists($this->factionsDataFolder))
            \mkdir($this->factionsDataFolder, 0777, true);

        if(!file_exists($this->playersDataFolder))
            \mkdir($this->playersDataFolder, 0777, true);
    }

    /**
     * @param $name
     * @return bool
     */
    public function addFaction($name)
    {
        if($this->factionExists($name))
            return false;

        $result = $this->getFactionConfig($name);

        if(!$result instanceof Config)
            throw new \RuntimeException("Something went wrong while retriving faction data from provider");

        return true;
    }

    /**
     * @param $facName
     * @param $userName
     * @return bool
     */
    public function addMember($facName, $userName)
    {
        if($facName === null || $userName === null)
            return false;

        $members = $this->getFactionConfig($facName)->get("members");

        if(!is_array($members))
            throw new \RuntimeException("Corrupted faction data found in: " . $facName);

        $members[] = $userName;

        $this->getFactionConfig($facName)->set("members", $members);

        return true;
    }

    /**
     * @param $name
     * @return bool
     */
    public function factionExists($name)
    {
        return file_exists($this->factionsDataFolder . strtolower($name) . ".yml");
    }

    /**
     * @param $name
     * @return Config
     */
    public function getFactionConfig($name)
    {
        return new Config($this->factionsDataFolder . strtolower($name) . ".yml", Config::YAML, [
            "name" => $name,
            "motd" => "Hello, World!",
            "members" => [
            ]
        ]);
    }

    /**
     * @param $userName
     * @return Config
     */
    public function getPlayerConfig($userName)
    {
        return new Config($this->playersDataFolder . strtolower($userName) . ".yml", Config::YAML, [
            "name" => $userName,
            "faction" => null
        ]);
    }

    /**
     * @param $userName
     * @return string
     */
    public function getPlayerFaction($userName)
    {
        $result = $this->getPlayerConfig($userName)->get("faction");

        if($result === null)
            return null;

        return $result;
    }

    /**
     * @param $name
     * @return bool
     */
    public function removeFaction($name)
    {
        $result = @unlink($this->factionsDataFolder . strtolower($name) . ".yml");

        if($result !== true)
            return false;

        return true;
    }

    /**
     * @param $facName
     * @param $userName
     * @return bool
     */
    public function removeMember($facName, $userName)
    {
        if($facName === null || $userName === null)
            return false;

        $members = $this->getFactionConfig($facName)->get("members");

        if(!is_array($members))
            throw new \RuntimeException("Corrupted faction data found in: " . $facName);

        $members = array_diff($members, $userName);

        $this->getFactionConfig($facName)->set("members", $members);

        return true;
    }

    /**
     * @param $name
     * @param $motd
     * @return bool
     */
    public function setMotd($name, $motd)
    {
        if(empty($motd))
            return false;

        $this->getFactionConfig($name)->set("motd", $motd);

        return true;
    }

    public function setPlayerFaction($userName, $facName)
    {
        if($userName === null)
            return false;

        $this->getPlayerConfig($facName)->set("faction", $facName);

        return true;
    }

    public function close()
    {
    }
}