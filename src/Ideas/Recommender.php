<?php
declare(strict_types=1);

namespace App\Ideas;

class Recommender extends Idea
{
    public string $title = 'Plavkový odporúčač';
    public string $intro = 'Vyrábame množstvo kombinácii strihov a farieb a ťažko sa to v katalógu prehľadáva. Odporúčač bude lepšie ponúkať vhodné produkty k práve zobrazenému.';

    public float $satisfaction = -0.05;
    public float $earns = 30;
    public float $halfEarns = 0.3;
    public float $fullEarns = 1;
    public float $doubleEarns = 1;
}
