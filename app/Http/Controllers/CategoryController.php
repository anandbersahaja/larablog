<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        return view('categories', [
            'title' => 'Category Post',
            'active' => 'category',
            'categories' => Category::all()
        ]);
    }

    // public function show(Category $category){
    //     return view('blog', [
    //         'title' => "Post Category: $category->name",
    //         'active' => 'category',
    //         'posts' => $category->posts->load('author', 'category')
    //     ]);
    // }

}
