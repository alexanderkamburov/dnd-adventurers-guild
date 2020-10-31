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
        'barbarian',
        'bard',
        'cleric',
        'druid',
        'fighter',
        'monk',
        'paladin',
        'ranger',
        'rogue',
        'sorcerer',
        'warlock',
        'wizard'
    ];

    const CLASS_ATTRIBUTES = [
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

    // exclusive cap
    const MAX_DC_EASY = 15;
    const MAX_DC_MEDIUM = 20;
    const MAX_DC_HARD = 25;

    const DC_EASY_CASH = [50, 300]; // LO, HI
    const DC_MEDIUM_CASH = [300, 800];
    const DC_HARD_CASH = [800, 1200];
    const DC_VERY_HARD_CASH = [1200, 1500];

    const QUEST_TYPES = [
        'exploration' => [
            'perception',
            'investigation',
            'stealth'
        ],
        'combat' => [
            'athletics',
            'acrobatics',
            'insight'
        ],
        'social' => [
            'persuasion',
            'intimidation',
            'insight'
        ],
        'sneak' => [
            'stealth',
            'sleight of hand',
            'investigation'
        ],
        'knowledge' => [
            'arcana',
            'history',
            'nature'
        ],
        'gather' => [
            'survival',
            'medicine',
            'nature'
        ]
    ];

    // by order of aptitude, desc
    const QUEST_ADVENTURERS = [
        'exploration' => [
            'ranger',
            'druid',
            'monk'
        ],
        'combat' => [
            'monk',
            'ranger',
            'cleric'
        ],
        'social' => [
            'bard',
            'sorcerer',
            'warlock'
        ],
        'sneak' => [
            'rogue',
            'monk',
            'wizard'
        ],
        'knowledge' => [
            'wizard',
            'rogue',
            ''
        ],
        'gather' => [
            'ranger',
            'druid',
            ''
        ]
    ];
}
