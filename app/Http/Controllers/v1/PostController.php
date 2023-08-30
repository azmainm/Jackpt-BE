<?php

namespace App\Http\Controllers\v1;

use App\Constants\ResponseMessages;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::where('user_id', auth()->user()->id)->get();
        if ($posts->count() > 0) {
            return $this->success(data: PostResource::collection($posts));
        }
        return $this->error('Not Found', 404);

    }

    public function store(Request $request): JsonResponse
    {
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'image' => $request->image,
            'product_name' => $request->product_name,
            'product_details' => $request->product_details,
            'category' => $request->category,
            'type' => $request->type,
        ]);

        return $this->success(data: new PostResource($post));
    }

    public function show($id): JsonResponse
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->error(ResponseMessages::NOT_FOUND, 404);
        }

        return $this->success(data: $post);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
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
        if (!$post) {
            return $this->error(ResponseMessages::NOT_FOUND, 404);
        }
        $post->delete();

        return $this->success();
    }

    
}
