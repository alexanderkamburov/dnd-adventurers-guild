<?php

function roll($numDice, $faces, $modifier = 0) {
    $total = 0;
    for ($i = 1; $i <= $numDice; $i++) {
        $roll = rand(1, $faces);
        $total += $roll;
    }

    return $total + $modifier;
}

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
// per stat: roll 4d6, drop lowest, sum; repeat for each stat; match best to class
// max 20 per stat
// 10 = average +0;
// +2 pts = +1 mod
// stat roll = 4d6 per stat, remove the smallest die
// ([a-zA-z]+)(?:\/)([a-zA-z]+)

function generateAdventurer() {
    $index = rand(0,count(CLASSES) - 1);
    $className = array_keys(CLASSES)[$index];
   $class = array_values(CLASSES)[$index];
   # $class = CLASSES['fighter'];


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

    $adventurer = new Adventurer;
    $adventurer->setClass($className);


    foreach ($class as $index => $attribute) {
        $matches = [];
        if (preg_match('/([a-zA-z]+)(?:\/)([a-zA-z]+)/', $attribute, $matches)) {
            $attribute = $matches[1]; // temporary
        }

        $adventurer->{'set' . ucFirst($attribute)}($stats[$index]);
    }

   var_dump($adventurer);
}

generateAdventurer();
