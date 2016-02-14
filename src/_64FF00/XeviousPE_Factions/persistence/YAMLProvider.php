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

    private $dataFolder, $trib;

    public function __construct(Tribble $tribble)
    {
        $this->trib = $tribble;

        $this->dataFolder = $this->trib->getDataFolder() . "factions/";

        if(!file_exists($this->dataFolder))
            \mkdir($this->dataFolder, 0777, true);
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
     * @param $name
     * @return bool
     */
    public function factionExists($name)
    {
        return file_exists($this->dataFolder . strtolower($name) . ".yml");
    }

    /**
     * @param $name
     * @return Config
     */
    public function getFactionConfig($name)
    {
        return new Config($this->dataFolder . strtolower($name) . ".yml", Config::YAML, [
            "name" => $name,
            "members" => [
            ]
        ]);
    }

    /**
     * @param $name
     * @return bool
     */
    public function removeFaction($name)
    {
        $result = @unlink($this->dataFolder . strtolower($name) . ".yml");

        if($result !== true)
            return false;

        return true;
    }

    public function close()
    {
    }
}