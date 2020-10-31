<?php

namespace AdventurersGuild;

class Quest
{
    const DIFFICULTY_EASY = 'easy';
    const DIFFICULTY_MEDIUM = 'medium';
    const DIFFICULTY_HARD = 'hard';
    const DIFFICULTY_VERY_HARD = 'very hard';

    protected $dc;
    protected $reward;
    protected $type;
    protected $difficulty;

    /**
     * @return mixed
     */
    public function getDc()
    {
        return $this->dc;
    }

    /**
     * @param mixed $dc
     *
     * @return self
     */
    public function setDc($dc)
    {
        $this->dc = $dc;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * @param mixed $reward
     *
     * @return self
     */
    public function setReward($reward)
    {
        $this->reward = $reward;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param mixed $difficulty
     *
     * @return self
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }


    public function isEasy()
    {
        return $this->difficulty == self::DIFFICULTY_EASY;
    }

    public function isMedium()
    {
        return $this->difficulty == self::DIFFICULTY_MEDIUM;
    }

    public function isHard()
    {
        return $this->difficulty == self::DIFFICULTY_HARD;
    }

    public function isVeryHard()
    {
        return $this->difficulty == self::DIFFICULTY_VERY_HARD;
    }
}
