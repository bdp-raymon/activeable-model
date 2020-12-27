<?php

namespace Alish\ActiveableModel\Tests;

use Alish\ActiveableModel\Tests\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase;
use Alish\ActiveableModel\ActiveableModelServiceProvider;

class ActiveableTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }

    protected function getPackageProviders($app)
    {
        return [ActiveableModelServiceProvider::class];
    }

    public function test_model_is_active_by_default()
    {
        /** @var Post $post */
        $post = Post::create();

        $this->assertTrue($post->is_active);
    }

    public function test_model_active_state()
    {
        /** @var Post $post */
        $post = Post::create();

        // default is active
        $this->assertTrue($post->is_active);

        // deactivate
        $post->deactivate();
        $this->assertFalse($post->is_active);

        // activate
        $post->activate();
        $this->assertTrue($post->is_active);
    }

    public function test_active_state_history()
    {
        $post = Post::create();
        // deactivate
        $post->deactivate();
        // activate
        $post->activate();

        $stateHistory = $post->activeStates()->get();

        $this->assertCount(2, $stateHistory);
    }

}
