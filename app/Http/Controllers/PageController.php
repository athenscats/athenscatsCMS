<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Page;
use Auth;

class PageController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'isAdmin'])->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Page::all();
        $title = __('pages.all');
        return view('admin.pages.index')->with('data', $data)->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('general.pages_add');
        return view('admin.pages.create')->with('title', $title);
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
            'content' => 'required',
        ]);

        Page::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);
    
        Session::flash('success', trans('pages.flash_new'));
        return redirect()->route('pages.index');
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
        $page = Page::find($id);
        $title = __('pages.update_post');
        return view('admin.pages.edit')->with('data', $page)->with('title', $title);
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
            'content' => 'required',
        ]);

        $page = Page::find($id);
        
        $page->title = $request->title;
        $page->content = $request->content;
        $page->save();

        Session::flash('success', trans('pages.flash_updated'));
        return redirect()->route('pages.index');
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
        $page = Page::find($id);
        $page->delete();
        Session::flash('success', trans('pages.flash_delete'));
        return redirect()->route('pages.index');
    }
}
