<?php


namespace App\Test\TestCase\Lib;


use App\Lib\CompanyNameGenerator;
use Cake\TestSuite\TestCase;

class CompanyNameGeneratorTest extends TestCase
{
    public function testCompanyName()
    {
        $generator = new CompanyNameGenerator();
        $names = $generator->generate();
        $this->assertCount(1, $names);
        $this->assertNotEmpty($names[0]);
    }
}
