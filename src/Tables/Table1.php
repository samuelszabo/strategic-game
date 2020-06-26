<?php

namespace App\Tables;

use App\Ideas\Idea1;
use App\Ideas\Idea2;
use App\Ideas\Idea3;

class Table1 implements TablesInterface
{
    public function getTitle(): string
    {
        return 'Ťažký kvartál';
    }

    public function getIntro(): string
    {
        return 'Čaká nás najlepší kvartál roka';
    }

    /**
     * @return Idea1[]|array
     */
    public function getIdeas(): array
    {
        return [
            new Idea1(),
            new Idea2(),
            new Idea3(),
        ];
    }
}
