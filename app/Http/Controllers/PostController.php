<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Tag;
use Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

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
        $categories = Category::all();

        if($categories->count() == 0)
        {
            Session::flash('info', 'Insert categories');
            return redirect()->back();
        }

        //$title = trans('trclient.all_clients');
        //$title = __('general.hotels_add');
        $title = 'Add Post';
        return view('admin.posts.create')->with('title', $title)
                                        ->with('categories', Category::all())
                                        ->with('tags', Tag::all());
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
            'featured' => 'required|image',
            'content' => 'required',
            'category_id' => 'required',
            
         
        ]);

        $featured = $request->featured;

        $featured_new_name = time() . $featured->getClientOriginalName();

        $featured->move('uploads/posts', $featured_new_name);

       //dd($request->all());

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'featured' => 'uploads/posts/' . $featured_new_name,
            'category_id' => $request->category_id,

        ]);

        $post->tags()->attach($request->tags);

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
        $post = Post::find($id);
        $title = __('posts.update_post');
        return view('admin.posts.edit')->with('data', $post)->with('title', $title)->with('categories', Category::all())->with('tags', Tag::all());
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'featured' => 'image',
            'content' => 'required',
            'category_id' => 'required',
            
         
        ]);

        $post = Post::find($id);

        if ($request->hasFile('featured'))
        {
            $featured = $request->featured;

            $featured_new_name = time() . $featured->getClientOriginalName();
    
            $featured->move('uploads/posts', $featured_new_name);

            $post->featured = 'uploads/posts/' . $featured_new_name;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();
        $post->tags()->sync($request->tags);

        Session::flash('success', trans('posts.flash_updated'));
        return redirect()->route('posts.index');
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

    public function trashed(){
        $data = Post::onlyTrashed()->get();
        $title = "All Trashed Posts";
        return view('admin.posts.trashed')->with('data', $data)->with('title', $title);
    }
    public function restore($id){
        $data = Post::withTrashed()->where('id', $id)->first();
        $data->restore();
        Session::flash('success', trans('posts.restore_post'));
        return redirect()->back();
  
    }
    public function kill($id){
        $data = Post::withTrashed()->where('id', $id)->first();
        $data->forceDelete();
        $data->tags()->detach();
        Session::flash('success', trans('posts.permadelete'));
        return redirect()->back();
  
    }
}
