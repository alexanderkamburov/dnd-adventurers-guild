<?php

namespace AdventurersGuild;

use Config\Config;

class GuildManagerReport
{
    const OUTCOME_COMPLETE_SUCCESS = 'complete success';
    const OUTCOME_CLOSE_SUCCESS = 'close success';
    const OUTCOME_CLOSE_FAILURE = 'close failure';
    const OUTCOME_COMPLETE_FAILURE = 'complete failure';

    const ADVENTURER_STATUS_NO_INJURY = 'no injury';
    const ADVENTURER_STATUS_MINOR_INJURY = 'minor injury';
    const ADVENTURER_STATUS_LIGHT_INJURY = 'light injury';
    const ADVENTURER_STATUS_MODERATE_INJURY = 'moderate injury';
    const ADVENTURER_STATUS_SEVERE_INJURY = 'severe injury';
    const ADVENTURER_STATUS_PERMANENT_INJURY = 'permanent injury';

    protected $adventurerStatus = self::ADVENTURER_STATUS_NO_INJURY;
    protected $outcomeType;
    /**
     * @var boolean
     */
    protected $questFailed = false;
    protected $reward = 0;
    protected $adventurerShare = 0;
    protected $guildShare = 0;
    protected $complication = false;
    protected $complicationType;
    protected $managerMisunderstoodQuest = false;
    protected $managerAdventurerJudgement;
    protected $quest;
    protected $perceivedQuest;
    protected $adventurer;

    /**
     * @return mixed
     */
    public function getAdventurerStatus()
    {
        return $this->adventurerStatus;
    }

    /**
     * @param mixed $adventurerStatus
     *
     * @return self
     */
    public function setAdventurerStatus($adventurerStatus)
    {
        $this->adventurerStatus = $adventurerStatus;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuestStatus()
    {
        return $this->questStatus;
    }

    /**
     * @return mixed
     */
    public function getComplication()
    {
        return $this->complication;
    }

    /**
     * @param mixed $complication
     *
     * @return self
     */
    public function setComplication($complication)
    {
        $this->complication = $complication;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComplicationType()
    {
        return $this->complicationType;
    }

    /**
     * @param mixed $complicationType
     *
     * @return self
     */
    public function setComplicationType($complicationType)
    {
        $this->complicationType = $complicationType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuest()
    {
        return $this->quest;
    }

    /**
     * @param mixed $quest
     *
     * @return self
     */
    public function setQuest(Quest $quest)
    {
        $this->quest = $quest;

        return $this;
    }

    public function markCompleteSuccess()
    {
        $this->outcomeType = self::OUTCOME_COMPLETE_SUCCESS;
        $this->questFailed = false;

        return $this;
    }

    public function markCloseSuccess()
    {
        $this->outcomeType = self::OUTCOME_CLOSE_SUCCESS;
        $this->questFailed = false;

        return $this;
    }

    public function markCloseFailure()
    {
        $this->outcomeType = self::OUTCOME_CLOSE_FAILURE;
        $this->questFailed = true;

        return $this;
    }

    public function markCompleteFailure()
    {
        $this->outcomeType = self::OUTCOME_COMPLETE_FAILURE;
        $this->questFailed = true;

        return $this;
    }

    public function isCompleteSuccess()
    {
        return $this->outcomeType == self::OUTCOME_COMPLETE_SUCCESS;
    }

    public function isCloseSuccess()
    {
        return $this->outcomeType == self::OUTCOME_CLOSE_SUCCESS;
    }

    public function isCloseFailure()
    {
        return $this->outcomeType == self::OUTCOME_CLOSE_FAILURE;
    }

    public function isCompleteFailure()
    {
        return $this->outcomeType == self::OUTCOME_COMPLETE_FAILURE;
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
        $this->adventurerShare = round(Config::ADVENTURER_SHARE * $reward);
        $this->guildShare = $this->reward - $this->adventurerShare;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdventurer()
    {
        return $this->adventurer;
    }

    /**
     * @param mixed $adventurer
     *
     * @return self
     */
    public function setAdventurer($adventurer)
    {
        $this->adventurer = $adventurer;

        return $this;
    }

    public function managerHasMisunderstoodQuest()
    {
        $this->managerMisunderstoodQuest = true;
        return $this;
    }

    public function hasManagerMisunderStoodQuest()
    {
        return ($this->managerMisunderstoodQuest === true);
    }

    /**
     * @return mixed
     */
    public function getManagerAdventurerJudgement()
    {
        return $this->managerAdventurerJudgement;
    }

    /**
     * @param mixed $managerAdventurerJudgement
     *
     * @return self
     */
    public function setManagerAdventurerJudgement($managerAdventurerJudgement)
    {
        $this->managerAdventurerJudgement = $managerAdventurerJudgement;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPerceivedQuest()
    {
        return $this->perceivedQuest;
    }

    /**
     * @param mixed $perceivedQuest
     *
     * @return self
     */
    public function setPerceivedQuest($perceivedQuest)
    {
        $this->perceivedQuest = $perceivedQuest;

        return $this;
    }

    public function setAdventurerStatusNoInjury()
    {
        $this->adventurerStatus = self::ADVENTURER_STATUS_NO_INJURY;
        return $this;
    }

    public function setAdventurerStatusMinorInjury()
    {
        $this->adventurerStatus = self::ADVENTURER_STATUS_MINOR_INJURY;
        return $this;
    }

    public function setAdventurerStatusLightInjury()
    {
        $this->adventurerStatus = self::ADVENTURER_STATUS_LIGHT_INJURY;
        return $this;
    }

    public function setAdventurerStatusModerateInjury()
    {
        $this->adventurerStatus = self::ADVENTURER_STATUS_MODERATE_INJURY;
        return $this;
    }

    public function setAdventurerStatusSevereInjury()
    {
        $this->adventurerStatus = self::ADVENTURER_STATUS_SEVERE_INJURY;
        return $this;
    }

    public function setAdventurerStatusPermanentInjury()
    {
        $this->adventurerStatus = self::ADVENTURER_STATUS_PERMANENT_INJURY;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdventurerShare()
    {
        return $this->adventurerShare;
    }

    /**
     * @return mixed
     */
    public function getGuildShare()
    {
        return $this->guildShare;
    }

    /**
     * @return boolean
     */
    public function isQuestFailed()
    {
        return $this->questFailed;
    }

    /**
     * @param boolean $questFailed
     *
     * @return self
     */
    public function setQuestFailed($questFailed)
    {
        $this->questFailed = $questFailed;

        return $this;
    }
}
