<?php

namespace Alish\ActiveableModel\Tests;

use Orchestra\Testbench\TestCase;
use Alish\ActiveableModel\ActiveableModelServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ActiveableModelServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
