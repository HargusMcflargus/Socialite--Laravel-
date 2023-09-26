<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Post;

class PostController extends Controller
{

    // Post New content
    public function store(Request $request){

        $newRequest = $request->validate([
            'content' => 'required'
        ]);
        $newPost = new Post;
        $newPost->userID = Auth::id();
        $newPost->userDisplayName = Auth::user()->name;
        $newPost->content = $request->input('content');
        $newPost->save();

        $request->session()->flash('success', 'Post successfully Created');
        return redirect(route('dashboard'));
    }

    // Fetch Post According to auth ID
    public function getMyPosts(Request $request) {
        return view('posts', [
            'posts' => Post::where('userID', Auth::id())->get()
        ]);
    }

    public function update(Request $request) {
        $newRequest = $request->validate([
            'content' => 'required'
        ]);

        $newPost = Post::where('id', $request['postID'])->first();
        $newPost->content = $request['content'];

        $newPost->save();
        
        $request->session()->flash('success', 'Post Has been updated Successfully');
        return redirect( route( 'posts' ) );

    }

    // Delete Post
    public function removePost(Request $request) {
        Post::where('id', $request['post'])->delete();
        $request->session()->flash('success', 'Post Has been deleted Successfully');
        return redirect( route( 'posts' ) );
    }
}
