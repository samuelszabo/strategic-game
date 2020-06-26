<?php


namespace App\Tables;

use App\Ideas\Idea;
use App\Ideas\IdeaInterface;

interface TablesInterface
{
    public function getTitle(): string;

    public function getIntro(): string;

    /**
     * @return Idea[]
     */
    public function getIdeas(): array;
}
