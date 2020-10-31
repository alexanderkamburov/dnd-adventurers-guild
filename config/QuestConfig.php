<?php

namespace Config;

interface QuestConfig
{
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
}
