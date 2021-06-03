<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index() {
        
        $posts = Post::where('published', 1)->limit(5)->get();

        return view('guest.index', compact('posts'));

    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->first();

        if ($post == null) {
            abort(404);
        }

        return view('guest.show', compact('post'));
    }
}
