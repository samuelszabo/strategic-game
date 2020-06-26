<?php

namespace App\Ideas;

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
        $classname = get_class($this);
        if ($pos = strrpos($classname, '\\'))
            return substr($classname, $pos + 1);
        return $pos;
    }
}
