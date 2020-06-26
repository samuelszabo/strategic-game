<?php
declare(strict_types=1);

namespace App\Tables;

interface TablesInterface
{
    public function getTitle(): string;

    public function getIntro(): string;

    /**
     * @return \App\Ideas\Idea[]
     */
    public function getIdeas(): array;
}
