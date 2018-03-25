<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class FrontEndController extends Controller
{
    //
    public function index() 
    {
        $count = Post::count();
        $skip = 1;
        $limit = $count - $skip; // the limit
        return view('index')->with('categories', Category::all()->take(4))
                            ->with('first_post', Post::orderBy('created_at', 'desc')->first())
                            ->with('posts', Post::orderBy('created_at', 'desc')->skip(1)->take($limit)->get());
    }

    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('frontend.single')->with('post', $post)->with('categories', Category::all()->take(4));
    }

    public function category($id)
    {
        $category = Category::find($id);
        $posts = Post::where('category_id', $id)->get();

        return view('frontend.category')->with('category', $category)
                                        ->with('posts', $posts)
                                        ->with('categories', Category::all()->take(4));
    }
}
