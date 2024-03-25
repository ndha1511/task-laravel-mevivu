<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function index() {
        $posts = DB::table('posts')->get();
        return view('post.index', compact('posts'));
    }

    public function create() {
        return view('post.create');
    }

    public function edit($id) {
        $post = DB::table('posts')->where('id', $id)->get()->first();
        return view('post.edit', compact('post'));
    }

    public function storage(Request $request) {

        $request->validate([
            'title' => 'required|unique:posts',
            'content' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif|max:5048'
        ]);
        // $request->file('image')->guessExtension(); // .png|.jpeg|.gif
        // $request->file('image')->getMimeType(); // image/*
        // $request->file('image')->getClientOriginalName(); // filename
        // $request->file('image')->getSize(); // filesize

        $imageName = 'image'.time().'_'.
            $request->file('image')->getClientOriginalName();

        $request->image->move(public_path('images'), $imageName);
        
        $post = new Post();
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->is_featured = $request->has('isFeatured') ? 1 : 0;
        $post->status = $request->input('status');
        $post->excerpt = $request->input('excerpt');
        $post->content = $request->input('content');
        $post->posted_at = now();
        $post->image = $imageName;
        $post->save();
        return redirect('/posts');
    }

    public function update($id, Request $request) {
        Post::where('id', $id)->update([
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'is_featured' => $request->has('isFeatured')? 1 : 0,
            'status' => $request->input('status'),
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content')
        ]);
       
        return redirect('/posts');

    }

    public function delete($id) {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts');
    }
}
