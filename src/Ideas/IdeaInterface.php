<?php
declare(strict_types=1);

namespace App\Ideas;

interface IdeaInterface
{
    public function getTitle(): string;

    public function getIntro(): string;
}
