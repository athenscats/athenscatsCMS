<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index()
    {
        //
        $data = Permission::all();
        $title = __('permissions.all');
        return view('admin.permissions.index')->with('data', $data)->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::get(); //Get all roles
        $title = __('permissions.new');
        return view('admin.permissions.create')->with('roles', $roles)->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|max:40',
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        if ($request->roles <> '') {
            foreach ($request->roles as $key => $value) {
                $role = Role::find($value);
                $role->permissions()->attach($permission);
            }
        }
        Session::flash('success', trans('permissions.flash_new'));
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title = __('permissions.edit');
        $permission = Role::findOrFail($id);
        $roles = Role::get(); //Get all roles
        return view('admin.permissions.edit')->with('roles', $roles)->with('data', $permission)->with('title', $title);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required',
        ]);
        $permission->name = $request->name;
        $permission->save();
        Session::flash('success', trans('permissions.flash_update'));
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $permission = Permission::find($id);
        $permission->delete();
        Session::flash('success', trans('permissions.flash_delete'));
        return redirect()->route('permissions.index');
    }
}