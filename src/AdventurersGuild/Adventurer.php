<?php

namespace AdventurersGuild;

class Adventurer {
    protected $class;
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

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     *
     * @return self
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }
}
