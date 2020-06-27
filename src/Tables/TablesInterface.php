<?php
declare(strict_types=1);

namespace App\Tables;

use App\Model\Entity\Game;

interface TablesInterface
{
    public function getTitle(): string;

    public function getIntro(): string;

    /**
     * @param \App\Model\Entity\Game $game
     * @return \App\Ideas\Idea[]
     */
    public function getIdeas(Game $game): array;
}
