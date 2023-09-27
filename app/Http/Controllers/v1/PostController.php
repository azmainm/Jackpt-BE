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
        return $this->success(data: PostResource::collection($posts));
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
            'division' => $request->division,
            'district' => $request->district,
            'area' => $request->area,
        ]);

        return $this->success(data: new PostResource($post));
    }

    public function show($id): JsonResponse
    {
        $post = Post::where('uuid', $id)->first();
        if (!$post) {
            return $this->error(ResponseMessages::NOT_FOUND, 404);
        }

        return $this->success(data: new PostResource($post));
    }

    public function update(Request $request, $uuid): JsonResponse
    {
        $post = Post::where('user_id', auth()->user()->id)->where('uuid', $uuid)->first();

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
            'division' => $request->division,
            'district' => $request->district,
            'area' => $request->area,
        ]);

        return $this->success();

    }

    public function destroy($uuid): JsonResponse
    {
        $post = Post::where('user_id', auth()->user()->id)->where('uuid', $uuid)->first();
        if (!$post) {
            return $this->error(ResponseMessages::NOT_FOUND, 404);
        }
        $post->delete();

        return $this->success();
    }
}
