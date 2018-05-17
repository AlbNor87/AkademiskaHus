<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Posts
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);

        // Return collection of posts as a resource
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info($request->all());

        // $post = $request->isMethod('put') ? Post::findOrFail
        // ($request->post_id) : new Post;
        
        // $post->id = $request->input('post_id');
        // $post->title = $request->input('title');
        // $post->body = $request->input('body');

        // if($post->save()){
        //     return new PostResource($post);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         // Get post
         $post = Post::findOrFail($id);

         // Return the single post as a resource
         return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get post
        $post = Post::findOrFail($id);

        if($post->delete()){
            return new PostResource($post);
        }
    }
}
