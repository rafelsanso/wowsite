<?php

namespace WowSite\Services\Realmd;

use WowSite\Services\Realmd\RealmdService;
use DB;
use WowSite\Models\RealmCharacter;
use WowSite\Models\GameCharacter;

class CharacterService extends RealmdService
{

	/**
     * Define the Race constants
     */
    const CHARACTER_RACE = [
        1 => 'Human',
        2 => 'Orc',
        3 => 'Dwarf',
        4 => 'Night Elf',
        5 => 'Undead',
        6 => 'Tauren',
        7 => 'Gnome',
        8 => 'Troll'
    ];

    /**
     * Define the Gender constants
     */
    const CHARACTER_GENDER = [
        0 => 'Male',
        1 => 'Female'
    ];

    /**
     * Define the Character Class constants
     */
    const CHARACTER_CLASS = [
        0  => 'Generic',
        1  => 'Unk1',
        2  => 'Unused',
        3  => 'Mage',
        4  => 'Warrior',
        5  => 'Warlock',
        6  => 'Priest',
        7  => 'Druid',
        8  => 'Rogue',
        9  => 'Hunter',
        10 => 'Paladin',
        11 => 'Shaman',
        12 => 'Unk2',
        13 => 'Potion',
        14 => 'Unused',
        15 => 'Death Knight',
        16 => 'Unused',
        17 => 'Pet'
    ];

	public function total()
	{
		return RealmCharacter::select(DB::raw('SUM(numchars) AS total'))
								->first()
								->total;
	}

	public function online()
	{
		return GameCharacter::where('online', '=', 1)->count();
	}

	public function armory()
	{
		return GameCharacter::select('guid', 'name', 'race', 'class', 'gender', 'level', 'money')
								->take(10)
								->get();
	}

    /**
     * Return the race of character from ID
     * @param  String $location
     * @return String
     */
    public static function getRace($raceID)
    {
        return static::CHARACTER_RACE[$raceID];
    }

    /**
     * Return the gender of character from ID
     * @param  String $location
     * @return String
     */
    public static function getGender($genderID)
    {
        return static::CHARACTER_GENDER[$genderID];
    }

    /**
     * Return the class of character from ID
     * @param  String $location
     * @return String
     */
    public static function getClass($classID)
    {
        return static::CHARACTER_CLASS[$classID];
    }
}