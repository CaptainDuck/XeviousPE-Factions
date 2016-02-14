<?php

namespace _64FF00\XeviousPE_Factions;

use _64FF00\XeviousPE_Factions\persistence\PointlessProvider;
use _64FF00\XeviousPE_Factions\persistence\YAMLProvider;

use pocketmine\command\PluginCommand;
use pocketmine\plugin\PluginBase;

class Tribble extends PluginBase
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

    private $provider;

    public function onEnable()
    {
        $this->getLogger()->warning("XeviousPE-Factions by 64FF00 \n \n" . base64_decode("X19fICAgX19fICBfX19fX19fX19fXyAgICBfX19fICBfXyAgICBfX19fX18gICAgX18gICAgX18gICAgICAgX19fX19fXy4uX18gICBfXy4gIF9fX19fX18gLl9fX19fX19fX19fLl9fX18gICAgX18gICAgX19fXyAgX19fX19fICAgLl9fX19fXyAgICAgICBfXyAgX19fICAgICAgIF9fX19fXyAgICAgX19fICAgICAgDQpcICBcIC8gIC8gfCAgIF9fX19cICAgXCAgLyAgIC8gfCAgfCAgLyAgX18gIFwgIHwgIHwgIHwgIHwgICAgIC8gICAgICAgfHwgIFwgfCAgfCB8ICAgX19fX3x8ICAgICAgICAgICB8XCAgIFwgIC8gIFwgIC8gICAvIC8gIF9fICBcICB8ICAgXyAgXCAgICAgfCAgfC8gIC8gICAgICAvICAgICAgfCAgIC8gICBcICAgICANCiBcICBWICAvICB8ICB8X18gICBcICAgXC8gICAvICB8ICB8IHwgIHwgIHwgIHwgfCAgfCAgfCAgfCAgICB8ICAgKC0tLS1gfCAgIFx8ICB8IHwgIHxfXyAgIGAtLS18ICB8LS0tLWAgXCAgIFwvICAgIFwvICAgLyB8ICB8ICB8ICB8IHwgIHxfKSAgfCAgICB8ICAnICAvICAgICAgfCAgLC0tLS0nICAvICBeICBcICAgIA0KICA+ICAgPCAgIHwgICBfX3wgICBcICAgICAgLyAgIHwgIHwgfCAgfCAgfCAgfCB8ICB8ICB8ICB8ICAgICBcICAgXCAgICB8ICAuIGAgIHwgfCAgIF9ffCAgICAgIHwgIHwgICAgICAgXCAgICAgICAgICAgIC8gIHwgIHwgIHwgIHwgfCAgICAgIC8gICAgIHwgICAgPCAgICAgICB8ICB8ICAgICAgLyAgL19cICBcICAgDQogLyAgLiAgXCAgfCAgfF9fX18gICBcICAgIC8gICAgfCAgfCB8ICBgLS0nICB8IHwgIGAtLScgIHwgLi0tLS0pICAgfCAgIHwgIHxcICAgfCB8ICB8X19fXyAgICAgfCAgfCAgICAgICAgXCAgICAvXCAgICAvICAgfCAgYC0tJyAgfCB8ICB8XCAgXC0tLS0ufCAgLiAgXCAgIF9fIHwgIGAtLS0tLi8gIF9fX19fICBcICANCi9fXy8gXF9fXCB8X19fX19fX3wgICBcX18vICAgICB8X198ICBcX19fX19fLyAgIFxfX19fX18vICB8X19fX19fXy8gICAgfF9ffCBcX198IHxfX19fX19ffCAgICB8X198ICAgICAgICAgXF9fLyAgXF9fLyAgICAgXF9fX19fXy8gIHwgX3wgYC5fX19fX3x8X198XF9fXCAoX18pIFxfX19fX18vX18vICAgICBcX19c") . "\n");

        $this->saveDefaultConfig();

        $this->doNothing();

        /** @var PluginCommand $command */
        $command = $this->getCommand("\x66");

        $command->setExecutor(new KerryGoesShopping($this));
    }

    private function doNothing()
    {
        $providerName = $this->getConfig()->get("dataProvider");

        switch(strtolower($providerName))
        {
            default:

                $provider = new YAMLProvider($this);

                $this->getLogger()->info("Using YAML data provider");

                break;
        }

        $this->provider = $provider;

        if(!isset($this->provider) || $this->provider === null || !($this->provider instanceof PointlessProvider))
            throw new \RuntimeException("Invalid data provider");
    }

    /*
          888  888          d8888 8888888b. 8888888
          888  888         d88888 888   Y88b  888
        888888888888      d88P888 888    888  888
          888  888       d88P 888 888   d88P  888
          888  888      d88P  888 8888888P"   888
        888888888888   d88P   888 888         888
          888  888    d8888888888 888         888
          888  888   d88P     888 888       8888888
    */

    /**
     * @return PointlessProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }
}
