<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Tag::all();
    }

    public function getById($id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return Tag::query()->findOrFail($id);
    }

    public function create($data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return Tag::query()->create($data);
    }

    public function update($id, $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        $tag = $this->getById($id);
        $tag->update($data);
        return $tag;
    }

    public function delete($id): void
    {
        $tag = $this->getById($id);
        $tag->delete();
    }
}
