<?php

//deprecated
function roll($numDice, $faces, $modifier = 0) {
    $total = 0;
    for ($i = 1; $i <= $numDice; $i++) {
        $roll = rand(1, $faces);
        $total += $roll;
    }

    return $total + $modifier;
}


// order matters
// npc classes => 2 highest stats
// barbarian => str, con
// bard => cha, dex
// cleric => wis, con/str
// druid => wis, con
// fighter => str/dex, con
// monk => dex, wis
// paladin => str, cha
// ranger => dex, wis
// rogue => dex, int/char
// sorcerer => cha, con
// warlock => cha, con
// wizard => int, con/dex


// 6 * 4d6, drop lowest, match best to class
// max 20 per stat
// 10 = average +0;
// +2 pts = +1 mod
// stat roll = 4d6 per stat, remove the smallest die


// 6 * 4d6, drop lowest, match best to class
// max 20 per stat
// 10 = average +0;
// +2 pts = +1 mod
// stat roll = 4d6 per stat, remove the smallest die



// complication: 1d20 roll; complication at different rolls for different dcs. easy quest: 1; medium: <=2; hard <= 4; vhard <=5;
// roll for another type of quest 1d6, new quest checks, 3 new checks, sum and divide by 2, round down to find success, max 3; increase reward with more successful checks (possibly, roll dice)


// generate quest type 1d6; determine mistake with roll 15%; if make mistake, roll 1d6 to determine random quest type; record real quest; will make checks against real quest
// generate npc for quest; dertemine mistake with roll 15%; if make mistake, roll 1d6 to pick npc with random proficiency



// mistake in determining quest type % eg. 15%; roll 1d6 to determine quest type
// npc generation with % mistake as well eg. 15%

// 1d20 + modifier

//0 Successes: Job fails; Roll on permanent injury table; Reduce Popularity by DC/2;
// 1 Success: Job fails; Adventurer escapes unharmed;
// 2 Successes: Half the payout; Gain Popularity equal to DC/2(round down)
// 3 Successes: Full payout; Gain Popularity equal to DC

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

// skill => modifier
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

// order matters
// npc classes => 2 highest stats
// barbarian => str, con
// bard => cha, dex
// cleric => wis, con/str
// druid => wis, con
// fighter => str/dex, con
// monk => dex, wis
// paladin => str, cha
// ranger => dex, wis
// rogue => dex, int/char
// sorcerer => cha, con
// warlock => cha, con
// wizard => int, con/dex
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
// 6 * 4d6, drop lowest, match best to class
// max 20 per stat
// 10 = average +0;
// +2 pts = +1 mod
// stat roll = 4d6 per stat, remove the smallest die
// ([a-zA-z]+)(?:\/)([a-zA-z]+)


function determineQuest() {
    $diceRoll = roll(1,6) - 1;
    $questType = array_keys(QUEST_TYPES)[$diceRoll];
    return $questType;
}

echo determineQuest();
