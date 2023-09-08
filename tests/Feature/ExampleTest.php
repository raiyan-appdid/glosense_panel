<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertSeeText('welcome to appdid!');
        $response->assertSeeText('This is the content of the main page!');
        $response->assertStatus(200);
    }
}
