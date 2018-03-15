<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Post::with('category')->get();
        //$title = trans('trclient.all_clients');
        //$title = __('general.hotels_view');
        $title = "All Posts";
        return view('admin.posts.index')->with('data', $data)->with('title', $title);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //

        //$title = trans('trclient.all_clients');
        //$title = __('general.hotels_add');
        $title = 'Add Post';
        return view('admin.posts.create')->with('title', $title)->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required|max:255',
            'featured' => 'image',
            'content' => 'required',
            'category_id' => 'required'
         
        ]);

        $featured = $request->featured;

        $featured_new_name = time() . $featured->getClientOriginalName();

        $featured->move('uploads/posts', $featured_new_name);

       //dd($request->all());

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'featured' => 'uploads/posts/' . $featured_new_name,
            'category_id' => $request->category_id,
           // 'featured' => 'uploads/posts/' . $featured_new_name

        ]);

        Session::flash('success', trans('posts.flash_new'));
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->delete();
        Session::flash('success', trans('posts.flash_delete'));
        return redirect()->route('posts.index');
    }
}
