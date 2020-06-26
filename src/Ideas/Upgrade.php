<?php
declare(strict_types=1);

namespace App\Ideas;

class Upgrade extends Idea
{
    public string $title = 'Údržba a zlepšovanie predošlých';
    public string $intro = 'Káva valcuje svet';

    public float $satisfaction = 0.5;
    public float $earns = 1000;
    public float $halfEarns = 0.3;
    public float $fullEarns = 1;
    public float $doubleEarns = 1;
}
