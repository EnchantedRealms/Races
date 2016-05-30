<?php

namespace xfury\races;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\entity\Effect;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class Commands{
	
	public $plugin;

	public function __construct(MainClass $pg){
		$this->plugin = $pg;
	}

	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		$fcmd = strtolower($cmd->getName());
		switch($fcmd){
			case "race":
				if(!$sender instanceof Player){
					$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACES> ".TextFormat::YELLOW."§r§cIn-game command only!");
					return;
				}
				if($this->plugin->hasRace($sender->getName()) == true){
					$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACES> ".TextFormat::YELLOW."§r§c You §eCANNOT§c change your race!");
					return;
				}
				if(count($args) != 1){
					$sender->sendMessage(TextFormat::YELLOW."Usage: /race <bunny | warrior | elf>");
					return;
				}
				switch(strtolower($args[0])){
					case "bunny":
						if(!isset($this->plugin->race[$sender->getName()])){
							$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACES> ".TextFormat::YELLOW."Are you sure you want to be a §eBUNNY§c? Once you select your race, you §eCANNOT§c change it! Type §e/race bunny§c again to confirm!");
							$this->plugin->race[$sender->getName()]["race"] = "bunny";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						if($this->plugin->race[$sender->getName()]["race"] != "bunny"){
							$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACES> ".TextFormat::YELLOW."Are you sure you want to be a §eBUNNY§c? Once you select your race, you §eCANNOT§c change it! Type §e/race bunny§c again to confirm!");
							$this->plugin->race[$sender->getName()]["race"] = "bunny";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						$this->plugin->setRace($sender->getName(), 0);
						$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACES> ".TextFormat::YELLOW."§r§cThe Enchanted Gods give you the power of... THE BUNNY!");
						unset($this->plugin->race[$sender->getName()]);
					break;
					case "warrior":
						if(!isset($this->plugin->race[$sender->getName()])){
							$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACFES> ".TextFormat::YELLOW."§r§cAre you sure you want to be a §eWARRIOR§c? Once you select your race, you §eCANNOT§c change it! Type §e/race warrior§c again to confirm!");
							$this->plugin->race[$sender->getName()]["race"] = "warrior";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						if($this->plugin->race[$sender->getName()]["race"] != "warrior"){
							$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACES> ".TextFormat::YELLOW."§r§cAre you sure you want to be a §eWARRIOR§c? Once you select your race, you §eCANNOT§c change it! Type §e/race warrior§c again to confirm!");
							$this->plugin->race[$sender->getName()]["race"] = "warrior";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						$this->plugin->setRace($sender->getName(), 1);
						$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACES> ".TextFormat::YELLOW."§r§cThe Enchanted Gods give you the power of... THE WARRIOR!");
						unset($this->plugin->race[$sender->getName()]);
					break;
					case "elf":
						if(!isset($this->plugin->race[$sender->getName()])){
							$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACES> ".TextFormat::YELLOW."§r§cAre you sure you want to be a§e ELF§c? Once you select your race, you §eCANNOT§c change it! Type §e/race elf§c again to confirm!");
							$this->plugin->race[$sender->getName()]["race"] = "elf";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						if($this->plugin->race[$sender->getName()]["race"] != "elf"){
							$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACES> ".TextFormat::YELLOW."§r§cAre you sure you want to be a§e ELF§c? Once you select your race, you §eCANNOT§c change it! Type §e/race elf§c again to confirm!");
							$this->plugin->race[$sender->getName()]["race"] = "elf";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						$this->plugin->setRace($sender->getName(), 2);
						$sender->sendMessage(TextFormat::GOLD."§b§lERPE RACES> ".TextFormat::YELLOW."§r§cThe Enchanted Gods give you the power of... THE ELF!");
						unset($this->plugin->race[$sender->getName()]);
					break;
					default:
						$sender->sendMessage(TextFormat::GOLD."§7§l>>§r§b RACES: §7§l<<");
						$sender->sendMessage(TextFormat::YELLOW."§cbunny");
						$sender->sendMessage(TextFormat::YELLOW."§chuman");
						$sender->sendMessage(TextFormat::YELLOW."§celf");
						$sender->sendMessage(TextFormat::YELLOW."§b§lERPE RACES> §4WARNING:§r§c Once your race is chosen, you §eCANNOT§c change your race!");
					break;
				}
			break;
		}
	}
}
