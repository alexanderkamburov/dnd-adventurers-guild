// chance to up difficulty. change from hard to v hard quest (not to increase dc, with roll)
const INJURY_PAYMENT_REST = [
        'minor injury' => [0, 0], // 1 - 30
        'light injury' => [50, 1], // 30 - 55
        'moderate injury' => [200, 2], // 55 - 75
        'severe injury' => [450, 3], // 75 - 90
        'permanent injury' => [500, INF], // @todo add option for 1000, 0 // 90+
    ];
