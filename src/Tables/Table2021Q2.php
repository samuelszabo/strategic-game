<?php
declare(strict_types=1);

namespace App\Tables;

use App\Ideas\CzechRepublic;
use App\Ideas\Hungary;
use App\Ideas\Preview3D;
use App\Ideas\Recommender;

class Table2021Q2 extends Table
{
    public function getTitle(): string
    {
        return 'Druhý kvartál';
    }

    public function getIntro(): string
    {
        return 'Čaká nás najlepší kvartál roka';
    }

    /**
     * @return \App\Ideas\Idea[]
     */
    public function availableIdeas(): array
    {
        return [
            new Preview3D(),
            new Recommender(),
            new Hungary(),
            new CzechRepublic(),
        ];
    }
}
