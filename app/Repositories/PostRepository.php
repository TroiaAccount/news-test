<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\PostTranslation;

class PostRepository
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Post::with('translations', 'tags')->get();
    }

    public function getById($id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return Post::with('translations', 'tags')->findOrFail($id);
    }

    public function create($data): Post
    {
        $post = new Post();
        $post->save();

        foreach ($data['translations'] as $translation) {
            $translation['post_id'] = $post->id;
            PostTranslation::query()->create($translation);
        }

        $post->tags()->attach($data['tags']);

        return $post;
    }

    public function update($id, $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        $post = $this->getById($id);

        // Оновлення перекладів
        foreach ($data['translations'] as $translationData) {
            $translation = $post->translations->where('language_id', $translationData['language_id'])->first();
            if ($translation) {
                $translation->update($translationData);
            } else {
                $translationData['post_id'] = $post->id;
                PostTranslation::query()->create($translationData);
            }
        }

        // Оновлення тегів
        $post->tags()->sync($data['tags']);

        return $post;
    }

    public function delete($id): void
    {
        $post = $this->getById($id);
        $post->delete();
    }


}
