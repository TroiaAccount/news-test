<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        $posts = $this->postRepository->getAll();
        return response()->json($posts);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'translations' => 'required|array',
            'tags' => 'required|array',
        ]);

        $post = $this->postRepository->create($data);
        return response()->json($post, 201);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $post = $this->postRepository->getById($id);
        return response()->json($post);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'translations' => 'array',
            'tags' => 'array',
        ]);

        $post = $this->postRepository->update($id, $data);
        return response()->json($post);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $this->postRepository->delete($id);
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
