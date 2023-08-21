<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Aws\Api\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post_ads(Request $request)
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
        if($post){
            return response()->json([
                'status' => 200,
                'message' => "Successfully Posted"
            ], 200);
        }else{
            return response()->json([
                'status' => 500,
                'message' => "Something went wrong!"
            ], 500);
        }
    }

}
