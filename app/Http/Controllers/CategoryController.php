<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Category::all();
        //$title = trans('trclient.all_clients');
        //$title = __('general.hotels_view');
        $title = "All Categories";
        return view('admin.categories.index')->with('data', $data)->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
                //$title = __('general.hotels_add');
                $title = 'Add Category';
                return view('admin.categories.create')->with('title', $title);
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
                //
                $this->validate($request, [
                    'name' => 'required|max:255',
                 
                ]);
        
                //$featured = $request->featured;
        
                //$featured_new_name = time() . $featured->getClientOriginalName();
        
               // $featured->move('uploads/posts', $featured_new_name);
        
                Category::create([
                    'name' => $request->name,
                   // 'featured' => 'uploads/posts/' . $featured_new_name
        
                ]);
        
                Session::flash('success', trans('categories.flash_new'));
                return redirect()->route('categories.index');
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
        $category = Category::find($id);
        $title = __('categories.update_category');
        return view('admin.categories.edit')->with('data', $category)->with('title', $title);
   
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
            'name' => 'required|max:255',
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        Session::flash('success', trans('categories.flash_update'));
        return redirect()->route('categories.index');
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
        $category = Category::find($id);
        $category->delete();
        Session::flash('success', trans('categories.flash_delete'));
        return redirect()->route('categories.index');
    }
}
