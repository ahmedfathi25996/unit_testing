<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PostController extends BaseController
{

    public function get_all()
    {
       $posts = Post::all();
       return response()->json($posts,200);

    }

    public function getSinglePost($post_id)
    {
       $post =  Post::find($post_id);
       if(!is_object($post))
       {
           return response()->json("this post not exist",404);
       }
       return response()->json($post,200);
    }

    public function save_post(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    public function update_post(Request $request,$post_id)
    {
        $post = Post::find($post_id);
        if(!is_object($post))
        {
            return response()->json("this post not exist",404);
        }
        $post = $post->update($request->all());
        return response()->json($post, 201);

    }

    public function deletePost($post_id)
    {
        $post = Post::find($post_id);
        if(!is_object($post))
        {
            return response()->json("this post not exist",404);
        }
        $post->delete();
        return response()->json(null, 204);
    }
}
