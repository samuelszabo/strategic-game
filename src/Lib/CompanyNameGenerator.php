<?php


namespace App\Lib;


use App\Lib\CompanyNameGenerator\FakerProvider;
use Faker\Factory;
use Faker\Generator;
use Faker\Provider\Base;
use josegonzalez\Dotenv\Filter\UnderscoreArrayFilter;

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
            $names[] = $this->faker->companyName;
        }
        return $names;
    }
}
