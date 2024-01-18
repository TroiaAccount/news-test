<?php

namespace Tests\Feature;

use Tests\TestCase;

class PostControllerTest extends TestCase
{

    private array $data = [
        'translations' => [
            ['language_id' => 1, 'title' => 'Test Title', 'description' => 'Test Description', 'content' => 'Test Content'],
        ],
        'tags' => [1, 2],
    ];

    public function test_can_get_all_posts()
    {
        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }

    public function test_can_create_post()
    {
        $response = $this->post('/api/posts', $this->data);
        $response->assertStatus(201);
    }

    public function test_can_get_post_by_id()
    {
        $post = \App\Models\Post::query()->create($this->data);

        $response = $this->get("/api/posts/{$post->id}");
        $response->assertStatus(200);
    }

    public function test_can_update_post()
    {
        $post = \App\Models\Post::query()->create($this->data);

        $data = [
            'translations' => [
                ['language_id' => 1, 'title' => 'Updated Title', 'description' => 'Updated Description', 'content' => 'Updated Content'],
            ],
            'tags' => [1, 2],
        ];

        $response = $this->put("/api/posts/{$post->id}", $data);
        $response->assertStatus(200);
    }

    public function test_can_delete_post()
    {
        $post = \App\Models\Post::create($this->data);

        $response = $this->delete("/api/posts/{$post->id}");
        $response->assertStatus(200);
    }
}
