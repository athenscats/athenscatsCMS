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
        return view('frontend.index')->with('categories', Category::all()->take(4))
                            ->with('first_post', Post::orderBy('created_at', 'desc')->first())
                            ->with('posts', Post::orderBy('created_at', 'desc')->skip(1)->take($limit)->paginate(6));
    }

    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('frontend.single')->with('post', $post)->with('categories', Category::all()->take(4));
    }

    public function category($cat_slug)
    {
        $category = Category::where('slug', $cat_slug)->first();
        $posts = Post::where('category_id', $category->id)->paginate(6);

        return view('frontend.category')->with('category', $category)
                                        ->with('posts', $posts)
                                        ->with('categories', Category::all()->take(4));
    }
}
