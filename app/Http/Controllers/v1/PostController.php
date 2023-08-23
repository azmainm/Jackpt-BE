<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Aws\Api\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::all();
        if($posts->count() > 0){
            return $this->success(data:$posts);
            
        }
        return $this->error("Not Found",404)
        
    }
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
        
public function show($id)
{
    $post = Post::find($id);
    if($post){
        return response()->json([
            'status' => 200,
            'message' => $post
        ], 200);  

    }else{
        return response()->json([
            'status' =>500,
            'message'=> "No such post found!"
        ],404);
    }
}
public function edit($id)
{
    $post = Post::find($id);
    if($post){
        return response()->json([
            'status' => 200,
            'message' => $post
        ], 200);  

    }else{
        return response()->json([
            'status' =>500,
            'message'=> "No such post found!"
        ],404);
    }  
}
public function update(Request $request, int $id )
{
    $post = Post::find($id);
   

    if ($post) {
        $post->update([
            'user_id' => $request->user_id,
            'image' => $request->image,
            'product_name' => $request->product_name,
            'product_details' => $request->product_details,
            'category' => $request->category,
            'type' => $request->type,
        ]);
        return response()->json([
            'status' => 200,
            'message' => "Post updated"
        ], 200);
    } else {
        return response()->json([
            'status' => 500,
            'message' => "Something Goes Wrong"
        ], 200);
    }


}


public function destroy($id)
{
    $post =Post::find($id);
    if($post){
        $post->delete();

    }else{

        return response()->json([
            'status' => 500,
            'message' => "Something Goes Wrong"
        ], 200);

    }

}









}
