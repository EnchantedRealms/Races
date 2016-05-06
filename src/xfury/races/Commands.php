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
					$sender->sendMessage(TextFormat::GOLD."[Race] ".TextFormat::YELLOW."Please run this command ingame!");
					return;
				}
				if($this->plugin->hasRace($sender->getName()) == true){
					$sender->sendMessage(TextFormat::GOLD."[Race] ".TextFormat::YELLOW."Your race cannot be changed!");
					return;
				}
				if(count($args) != 1){
					$sender->sendMessage(TextFormat::YELLOW."Usage: /race <firemage:tank:wizard>");
					return;
				}
				switch(strtolower($args[0])){
					case "flamemage":
						if(!isset($this->plugin->race[$sender->getName()])){
							$sender->sendMessage(TextFormat::GOLD."[Races] ".TextFormat::YELLOW."Are you sure you want to be a flamemage? Once you select your race, you cannot switch it! Type /race flamemage again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "flamemage";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						if($this->plugin->race[$sender->getName()]["race"] != "flamemage"){
							$sender->sendMessage(TextFormat::GOLD."[Races] ".TextFormat::YELLOW."Are you sure you want to be a flamemage? Once you select your race, you cannot switch it! Type /race flamemage again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "flamemage";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						$this->plugin->setRace($sender->getName(), 0);
						$sender->sendMessage(TextFormat::GOLD."[Race] ".TextFormat::YELLOW."You are now a flamemage!");
						unset($this->plugin->race[$sender->getName()]);
					break;
					case "tank":
						if(!isset($this->plugin->race[$sender->getName()])){
							$sender->sendMessage(TextFormat::GOLD."[Races] ".TextFormat::YELLOW."Are you sure you want to be a tank? Once you select your race, you cannot switch it! Type /race tank again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "tank";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						if($this->plugin->race[$sender->getName()]["race"] != "tank"){
							$sender->sendMessage(TextFormat::GOLD."[Races] ".TextFormat::YELLOW."Are you sure you want to be a tank? Once you select your race, you cannot switch it! Type /race tank again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "tank";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						$this->plugin->setRace($sender->getName(), 1);
						$sender->sendMessage(TextFormat::GOLD."[Race] ".TextFormat::YELLOW."You are now a jumper!");
						unset($this->plugin->race[$sender->getName()]);
					break;
					case "wizard":
						if(!isset($this->plugin->race[$sender->getName()])){
							$sender->sendMessage(TextFormat::GOLD."[Races] ".TextFormat::YELLOW."Are you sure you want to be a wizard? Once you select your race, you cannot switch it! Type /race wizard again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "wizard";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						if($this->plugin->race[$sender->getName()]["race"] != "wizard"){
							$sender->sendMessage(TextFormat::GOLD."[Races] ".TextFormat::YELLOW."Are you sure you want to be a Wizard? Once you select your race, you cannot switch it! Type /race wizard again to choose!");
							$this->plugin->race[$sender->getName()]["race"] = "wizard";
							$this->plugin->race[$sender->getName()]["timestamp"] = time();
							return;
						}
						$this->plugin->setRace($sender->getName(), 2);
						$sender->sendMessage(TextFormat::GOLD."[Race] ".TextFormat::YELLOW."You are now a Wizard!");
						unset($this->plugin->race[$sender->getName()]);
					break;
					default:
						$sender->sendMessage(TextFormat::GOLD."Availible races:");
						$sender->sendMessage(TextFormat::YELLOW."FlameMage");
						$sender->sendMessage(TextFormat::YELLOW."Tank");
						$sender->sendMessage(TextFormat::YELLOW."Wizard");
						$sender->sendMessage(TextFormat::YELLOW."WARNING: Once your race is chosen, you cannot choose it again!");
					break;
				}
			break;
		}
	}
}
