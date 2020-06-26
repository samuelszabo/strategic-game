<?php
declare(strict_types=1);

namespace App\Lib;

use App\Lib\CompanyNameGenerator\FakerProvider;
use Faker\Factory;
use Faker\Generator;

class CompanyNameGenerator
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
        $this->faker->addProvider(new FakerProvider($this->faker));
    }

    /**
     * @param int $number
     * @return string[]
     */
    public function generate($number = 1): array
    {
        $names = [];
        for ($i = 1; $i <= $number; $i++) {
            /** @phpstan-ignore-next-line */
            $names[] = $this->faker->companyName;
        }

        return $names;
    }
}
