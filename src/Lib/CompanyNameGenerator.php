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
     * @return array<int, int|string>
     */
    public function generate($number = 1): array
    {
        $attempts = $number * 30;
        $names = [];
        for ($i = 1; $i <= $attempts; $i++) {
            /**
             * @var string $name
             * @phpstan-ignore-next-line
             */
            $name = $this->faker->companyName;
            $names[] = $name;
        }

        return (array)array_rand(array_flip($names), $number);
    }
}
