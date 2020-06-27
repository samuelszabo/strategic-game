<?php
declare(strict_types=1);

namespace App\Ideas;

use App\Model\Entity\Game;

abstract class Idea
{
    public string $title;
    public string $intro;

    public float $satisfaction;
    public float $earns;
    public float $halfEarns;
    public float $fullEarns;
    public float $doubleEarns;

    public function getName(): string
    {
        $classname = static::class;
        $pos = strrpos($classname, '\\');

        return substr($classname, $pos + 1);
    }

    public function isApplicable(Game $game): bool
    {

        if ($game->getBets($this) > 0) {
            return false;
        }

        return true;
    }
}
