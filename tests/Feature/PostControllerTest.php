<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /** @test */
    public function index_displays_posts()
    {
        $response = $this->get('/posts');

        $response->assertStatus(200);
        $response->assertSee('First Post'); // Update this line to match actual content
    }
}
