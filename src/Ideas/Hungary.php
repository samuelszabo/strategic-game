<?php
declare(strict_types=1);

namespace App\Ideas;

class Hungary extends Idea
{
    public string $title = 'Rozšírenie do Maďarska';
    public string $intro = 'Objavil sa potenciálny obchodný partner, ktorý by zastrešil prevádzku eshopu v Maďarsku. ' .
    'Je potrebné upraviť eshop do ďalšieho jazyka a logistiku pripraviť na zasielanie do zahraničia. ' .
    'Maďarsko má raz toľko obyvateľov ako Slovensko, očakávania sú veľké.';

    public float $satisfaction = -0.1;
    public float $earns = 5;
    public float $halfEarns = 0;
    public float $fullEarns = 1;
    public float $doubleEarns = 1;
}
