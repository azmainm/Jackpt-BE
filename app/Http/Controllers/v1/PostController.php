<?php

namespace App\Http\Controllers\v1;

use App\Constants\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        if ($posts->count() > 0) {
            return $this->success(data: $posts);

        }

        return $this->error('Not Found', 404);

        return $this->error("Not Found",404);
        
    }

    public function store(Request $request): JsonResponse
    {
        $post = Post::create([
            'uuid' => $request->uuid,
            'user_id' => $request->user_id,
            'image' => $request->image,
            'product_name' => $request->product_name,
            'product_details' => $request->product_details,
            'category' => $request->category,
            'type' => $request->type,
        ]);

        return $this->success(data: $post);
    }

    public function show($id): JsonResponse
    {
        $post = Post::find($id);
        if (! $post) {
            return $this->error(ResponseMessages::NOT_FOUND, 404);
        }

        return $this->success(data: $post);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $post = Post::find($id);

        if (! $post) {
            return $this->error(ResponseMessages::NOT_FOUND, 404);
        }
        $post->update([
            'user_id' => $request->user_id,
            'image' => $request->image,
            'product_name' => $request->product_name,
            'product_details' => $request->product_details,
            'category' => $request->category,
            'type' => $request->type,
        ]);

        return $this->success();

    }

    public function destroy($id): JsonResponse
    {
        $post = Post::find($id);
        if (! $post) {
            return $this->error(ResponseMessages::NOT_FOUND, 404);
        }
        $post->delete();

        return $this->success();

    }

    public function abc()
    {
        
    }
}
