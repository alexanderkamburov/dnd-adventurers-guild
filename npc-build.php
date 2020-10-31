<?php

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
class Adventurer {
    protected $strength;
    protected $dexterity;
    protected $constitution;
    protected $intelligence;
    protected $wisdom;
    protected $charisma;

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param mixed $strength
     *
     * @return self
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDexterity()
    {
        return $this->dexterity;
    }

    /**
     * @param mixed $dexterity
     *
     * @return self
     */
    public function setDexterity($dexterity)
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConstitution()
    {
        return $this->constitution;
    }

    /**
     * @param mixed $constitution
     *
     * @return self
     */
    public function setConstitution($constitution)
    {
        $this->constitution = $constitution;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIntelligence()
    {
        return $this->intelligence;
    }

    /**
     * @param mixed $intelligence
     *
     * @return self
     */
    public function setIntelligence($intelligence)
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWisdom()
    {
        return $this->wisdom;
    }

    /**
     * @param mixed $wisdom
     *
     * @return self
     */
    public function setWisdom($wisdom)
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCharisma()
    {
        return $this->charisma;
    }

    /**
     * @param mixed $charisma
     *
     * @return self
     */
    public function setCharisma($charisma)
    {
        $this->charisma = $charisma;

        return $this;
    }
}

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

function generateAdventurer() {
   $class = array_values(CLASSES)[rand(0,count(CLASSES) - 1)];


   $statCount = 6;
   $stats = [];

   for ($i = 0; $i < $statCount; $i++) {
       $rolls = [];
        for ($j = 0; $j < 4; $j++) {
            array_push($rolls, roll(1, 6));
        }

        $min = min($rolls);

        foreach ($rolls as $j => $roll) {
            if (count($rolls) < 4) {
                continue;
            }

            if ($roll == $min) {
                unset($rolls[$j]);
            }
        }

        $rolls = array_values($rolls);
        //$rolls =
        //var_dump(array_diff($rolls, [min($rolls)]));
        $stat = array_sum($rolls);

        array_push($stats, $stat);
   }

    rsort($stats, SORT_NUMERIC);
    var_dump($stats);
}

function determineQuest() {
    $diceRoll = roll(1,6) - 1;
    $questType = array_keys(QUEST_TYPES)[$diceRoll];
    return $questType;
}

echo determineQuest();
