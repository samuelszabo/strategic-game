<?php
declare(strict_types=1);

namespace App\Tables;

use App\Ideas\CzechRepublic;
use App\Ideas\Hungary;
use App\Ideas\Preview3D;
use App\Ideas\Recommender;

class Table2021Q1 extends Table
{
    public function getTitle(): string
    {
        return 'Príprava na sezónu (marec - máj)';
    }

    public function getIntro(): string
    {
        return 'Na jar sa pomali rozbiehajú čísla ale ešte máme priestor..';
    }

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
