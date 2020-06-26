<?php
declare(strict_types=1);

namespace App\Ideas;

class Maintenance extends Idea
{
    public string $title = 'Údržba a zlepšovanie';
    public string $intro = 'Maintanance';

    public float $satisfaction = 0.2;
    public float $earns = 1000;
    public float $halfEarns = 0.3;
    public float $fullEarns = 1;
    public float $doubleEarns = 1;
}
