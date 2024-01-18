<?php
namespace Tests\Feature;

use Tests\TestCase;

class TagControllerTest extends TestCase
{
    private array $data = [
        'name' => 'Test Tag',
    ];

    public function test_can_get_all_tags()
    {
        $response = $this->get('/api/tags');
        $response->assertStatus(200);
    }

    public function test_can_create_tag()
    {
        $response = $this->post('/api/tags', $this->data);
        $response->assertStatus(201);
    }

    public function test_can_get_tag_by_id()
    {
        $tag = \App\Models\Tag::create($this->data);

        $response = $this->get("/api/tags/{$tag->id}");
        $response->assertStatus(200);
    }

    public function test_can_update_tag()
    {
        $tag = \App\Models\Tag::create($this->data);

        $data = [
            'name' => 'Updated Tag',
        ];

        $response = $this->put("/api/tags/{$tag->id}", $data);
        $response->assertStatus(200);
    }

    public function test_can_delete_tag()
    {
        $tag = \App\Models\Tag::create($this->data);

        $response = $this->delete("/api/tags/{$tag->id}");
        $response->assertStatus(200);
    }
}
