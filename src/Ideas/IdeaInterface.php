<?php


namespace App\Ideas;


interface IdeaInterface
{
    public function getTitle(): string;

    public function getIntro(): string;
}
