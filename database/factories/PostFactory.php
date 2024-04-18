<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'user_id' => function () {
                return User::factory()->create()->id; // Creates a user for each post
            },
            'cover_image' => 'noimage.jpg',
        ];
    }
}
