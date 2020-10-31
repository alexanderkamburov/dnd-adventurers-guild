<?php

namespace Config;

interface Config
{
    const STAT_TYPES = [
        'strength',
        'dexterity',
        'constitution',
        'intelligence',
        'wisdom',
        'charisma'
    ];

    const SKILL_CHECKS = [
        'perception' => 'wisdom',
        'investigation' => 'intelligence',
        'stealth' => 'dexterity',
        'athletics' => 'strength',
        'acrobatics' => 'dexterity',
        'insight' => 'wisdom',
        'persuasion' => 'charisma',
        'intimidation' => 'charisma',
        'sleight of hand' => 'dexterity',
        'arcana' => 'intelligence',
        'history' => 'intelligence',
        'nature' => 'intelligence',
        'survival' => 'wisdom',
        'medicine' => 'intelligence',
    ];

    const CLASSES = [
        'barbarian' => ['strength', 'constitution'],
        'bard' => ['charisma', 'dexterity'],
        'cleric' => ['wisdom', 'constitution'],
        'druid' => ['wisdom', 'constitution'],
        'fighter' => ['strength/dexterity', 'constitution'],
        'monk' => ['dexterity', 'wisdom'],
        'paladin' => ['strength', 'charisma'],
        'ranger' => ['dexterity', 'wisdom'],
        'rogue' => ['dexterity', 'intelligence/charisma'],
        'sorcerer' => ['charisma', 'constitution'],
        'warlock' => ['charisma', 'constitution'],
        'wizard' => ['intelligence', 'constitution/dexterity'],
    ];
}
