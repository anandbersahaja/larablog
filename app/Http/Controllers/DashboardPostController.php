<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      return view('dashboard.posts.index', [
        'posts' => Post::where('user_id', auth()->user()->id)->get()
      ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.posts.create', [
          'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // return $request;
        //

        // return $request->file('image')->store('post-image');

        $validatedData = $request->validate([
          'title' => 'bail|required|min:3',
          'slug' => 'bail|required|unique:posts',
          'category_id' => 'required',
          'image' => 'image|file|max:1024',
          'body' => 'bail|required'
        ]);

        if($request->file('image')) {
          $validatedData['image'] = $request->file('image')->store('post-image');
        }
        
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        // return $validatedData;
        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post have been added!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('dashboard.posts.show', [
          'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('dashboard.posts.edit', [
          'post' => $post,
          'categories' => Category::all()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //

        // dd($post);

        $rules = [
          'title' => 'bail|required|min:3',
          'category_id' => 'required',
          'image' => 'image|file|max:1024', 
          'body' => 'bail|required|min:200'
        ];

        if($request->slug != $post->slug) {
          $rules['slug'] = 'bail|required|unique:posts';
        }
        
        $validated = $request->validate($rules);
        
        if($request->file('image')){
          $validated['image'] = $request->file('image')->store('post-image');
          if($request -> oldImg){
            Storage::delete($request->oldImg);
          }
        }

        $validated['user_id'] = auth()->user()->id;
        $validated['excerpt'] = Str::limit(strip_tags($request->body), 200);
        

        Post::where('id', $post->id)->update($validated);

        return redirect('/dashboard/posts')->with('success', "Post has been edited!");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Request $request)
    {
        //
        if($post -> image){
          Storage::delete($post -> image);
        }

        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', "Your post, $post->title has been deleted!");
    }

    public function checkSlug(Request $request){
      $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
      return response()->json(['slug' => $slug]);
    }
}
