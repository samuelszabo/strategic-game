<?php
declare(strict_types=1);

namespace App\Ideas;

class Idea2 extends Idea
{
    public string $title = 'Nové Sitemapy';
    public string $intro = 'Google nas potrebuje indexovať';

    public float $satisfaction = -0.1;
    public float $earns = 1000;
    public float $halfEarns = 0.3;
    public float $fullEarns = 1;
    public float $doubleEarns = 1;
}
