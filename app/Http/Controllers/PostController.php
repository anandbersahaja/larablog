<?php

namespace App\Http\Controllers;
use \App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){
        
        // Read database (cara 1)
        // $posts = DB::select('select * from posts');
        
        // Read database (cara 2)
        // dd(request('search'));
        
        $posts = Post::latest()->filter(request(['search', 'category', 'author']));

        return view('blog', [
            'title' => 'Blog Posts',
            'active' => 'blog',
            'posts' => $posts->paginate(5)->withQueryString()
        ]);
    }

    // Route Model Binding
    public function show(Post $post){
        
        return view('post', [
            'title' => $post->title,
            'active' => 'blog',
            'post' => $post,
            // 'category' => Post->cate
        ]);
    }


}
