<?php

use AdventurersGuild\GuildManager;
use AdventurersGuild\QuestFactory;
use AdventurersGuild\AdventurerFactory;

require __DIR__ . '/vendor/autoload.php';

$manager = new GuildManager(new AdventurerFactory, new QuestFactory);

$report = $manager->manageGuild();
var_dump($report);
