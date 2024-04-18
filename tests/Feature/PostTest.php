<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_post()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'New Post',
            'body' => 'This is the body of the new post.'
            // Skip 'cover_image'
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', [
            'title' => 'New Post'
        ]);
    }

    public function test_user_can_view_post()
    {
        // Create a user and a post using factories
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'title' => 'Unique Title',
            'body' => 'Unique content for the post.'
        ]);

        // Act as the created user and attempt to view the post
        $response = $this->actingAs($user)->get("/posts/{$post->id}");

        // Assert the response status is OK and the expected data is displayed
        $response->assertOk();
        $response->assertSee('Unique Title');
        $response->assertSee('Unique content for the post.');
    }

    public function test_user_can_update_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put("/posts/{$post->id}", [
            'title' => 'Updated Title',
            'body' => 'Updated body of the post.'
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', [
            'title' => 'Updated Title',
            'body' => 'Updated body of the post.'
        ]);
    }

    public function test_user_can_delete_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete("/posts/{$post->id}");

        $response->assertRedirect('/posts');
        $this->assertDeleted($post);
    }
}
