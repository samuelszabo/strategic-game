<?php
declare(strict_types=1);

namespace App\Ideas;

class Preview3D extends Idea
{
    public string $title = '3D náhľad plaviek na zákazníkoch';
    public string $intro = 'Zákazník si vie vyskúšať plavky z domu. Stačí nahrať fotku a  ...';

    public float $satisfaction = -0.1;
    public float $earns = 20;
    public float $halfEarns = 0;
    public float $fullEarns = 0.5;
    public float $doubleEarns = 1;
}
