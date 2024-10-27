<?php

declare(strict_types=1);

namespace Echore\PluginDelegate;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginEnableOrder;
use RuntimeException;
use Symfony\Component\Filesystem\Path;

class Main extends PluginBase {

	protected function onEnable(): void {
		$config = Path::join($this->getDataFolder(), "delegate_path.txt");
		if (!file_exists($config)) {
			throw new RuntimeException("Please specify delegate path (plugins_data/PluginDelegate/delegate_path.txt)");
		}

		$delegatePath = file_get_contents($config);
		if (file_exists($delegatePath) && is_dir($delegatePath)) {
			$this->getServer()->getPluginManager()->loadPlugins($delegatePath);
			$this->getServer()->enablePlugins(PluginEnableOrder::STARTUP);
		} else {
			throw new RuntimeException("Invalid delegate path");
		}

	}
}
