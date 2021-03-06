<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $validation = [
        'title' => 'required|string|max:255|unique:posts',
        'date' => 'required|date',
        'content' => 'required|string',
        'image' => 'nullable|url'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->validation);

        $data = $request->all();

        if ( !isset($data['published'])) {
            $data['published'] = false;
        } else {
            $data['published'] = true;
        }

        $data['slug'] = Str::slug($data['title'], '-');

        // $newPost = new Post();
        // $newPost->title = $data['title'];
        // $newPost->date = $data['date'];
        // $newPost->content = $data['content'];
        // $newPost->image = $data['image'];
        // $newPost->slug = Str::slug($data['title'], '-');
        // $newPost->published = $data['published'];
        // $newPost->save();

        Post::create($data);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:posts,title,' .$post->id,
            'date' => 'required|date',
            'content' => 'required|string',
            'image' => 'nullable|url'
        ]);

        $data = $request->all();

        if ( !isset($data['published'])) {
            $data['published'] = false;
        } else {
            $data['published'] = true;
        }

        $data['slug'] = Str::slug($data['title'], '-');

        $post->update($data);

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'Il post ?? stato eliminato!');
    }
}
