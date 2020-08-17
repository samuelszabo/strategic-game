<?php
declare(strict_types=1);

namespace App\Tables;

use App\Model\Entity\Game;

abstract class Table implements TablesInterface
{
    abstract public function getTitle(): string;

    abstract public function getIntro(): string;

    /**
     * @return \App\Ideas\Idea[]
     */
    abstract public function availableIdeas(): array;

    public function getIdeas(Game $game): array
    {
        $ideas = [];
        foreach ($this->availableIdeas() as $idea) {
            if ($idea->isApplicable($game)) {
                $ideas[] = $idea;
            }
        }

        return $ideas;
    }
}
