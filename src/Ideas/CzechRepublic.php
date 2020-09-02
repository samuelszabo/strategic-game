<?php
declare(strict_types=1);

namespace App\Ideas;

use App\Model\Entity\Game;

class CzechRepublic extends Idea
{
    public string $title = 'Rozšírenie do Česka';
    public string $intro = 'Maďarsko nevyšlo, no obchodníci ťa stále tlačia do rozšírenia do ČR, ' .
    'tento krát pod vlastnou réžiou, bez obchodného partnera. Systém už máme pripravený vďaka Maďarsku.';

    public float $satisfaction = -0.1;
    public float $earns = 5;
    public float $halfEarns = 0;
    public float $fullEarns = 1;
    public float $doubleEarns = 1;

    public function isApplicable(Game $game): bool
    {
        if ($game->getBets(new Hungary()) >= 0.5) {
            return true;
        }

        return false;
    }
}
