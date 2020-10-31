<?php

namespace AdventurersGuild;

use AdventurersGuild\QuestFactory;
use AdventurersGuild\AdventurerFactory;
use AdventurersGuild\GuildManagerReport;

class GuildManager
{
    protected $adventurerFactory;
    protected $questFactory;

    public function __construct(AdventurerFactory $adventurerFactory, QuestFactory $questFactory)
    {

        $this->adventurerFactory = $adventurerFactory;
        $this->questFactory = $questFactory;
    }

    public function manageGuild()
    {
        $report = new GuildManagerReport;
        $quest = $this->questFactory->createQuest();
        $report->setQuest($quest);
        $perceivedQuest = $quest;

        $understandQuest = Dice::roll(1, 100);
        if ($understandQuest <= 15) {
            // misunderstand quest
            $perceivedQuest = $this->questFactory->misunderstandQuest($quest);
            $report->managerHasMisunderstoodQuest();
        }

        $report->setPerceivedQuest($perceivedQuest);

        $adventurerJudgementRoll = Dice::roll(1, 100);
        switch ($adventurerJudgementRoll) {
            case $adventurerJudgementRoll <= 40:
                $adventurerJudgement = 'excellent';
                break;

            case $adventurerJudgementRoll <= 65:
                $adventurerJudgement = 'good';
                break;

            case $adventurerJudgementRoll <= 90:
                $adventurerJudgement = 'adequate';
                break;

            default:
                $adventurerJudgement = 'poor';
                break;
        }
        $report->setManagerAdventurerJudgement($adventurerJudgement);

        $adventurer = $this->adventurerFactory->createQuestAdventurer($perceivedQuest, $adventurerJudgement);
        $report->setAdventurer($adventurer);

        $adventureSimulator = new AdventureSimulator($this->questFactory);
        $adventureSimulator->simulateQuest($quest, $adventurer, $report);

        return $report;
    }
}
