<?php

namespace App\Http\Controllers;

use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $tags = $this->tagRepository->getAll();
        return response()->json($tags);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $tag = $this->tagRepository->create($data);
        return response()->json($tag, 201);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $tag = $this->tagRepository->getById($id);
        return response()->json($tag);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'name' => 'string',
        ]);

        $tag = $this->tagRepository->update($id, $data);
        return response()->json($tag);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $this->tagRepository->delete($id);
        return response()->json(['message' => 'Tag deleted successfully']);
    }
}
