<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\block;

use pocketmine\level\Level;

class WallSign extends StandingSign{

	protected $id = Block::WALL_SIGN;

	public function getName() : string{
		return "Wall Sign";
	}

	public function onUpdate(int $type){
		$faces = [
			2 => 3,
			3 => 2,
			4 => 5,
			5 => 4,
		];
		if($type === Level::BLOCK_UPDATE_NORMAL){
			if(isset($faces[$this->meta])){
				if($this->getSide($faces[$this->meta])->getId() === Block::AIR){
					$this->getLevel()->useBreakOn($this);
				}
				return Level::BLOCK_UPDATE_NORMAL;
			}
		}
		return false;
	}

	public function getBitmaskInfo() : array{
		return [
			1 => self::BITMASK_ROTATION,
			2 => self::BITMASK_ROTATION,
			4 => self::BITMASK_ROTATION,
			8 => self::BITMASK_UNUSED
		];
	}
}
