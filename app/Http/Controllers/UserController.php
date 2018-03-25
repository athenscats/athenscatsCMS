<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;


//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index()
    {
        //
        $data = User::with('roles:name')->get();
        //$title = trans('trclient.all_clients');
        //$title = __('general.hotels_view');
        $title = __('users.all');
        return view('admin.users.index')->with('data', $data)->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::get();
        $title = __('users.new');
        return view('admin.users.create')->with('roles', $roles)->with('title', $title);
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
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $user = User::create($request->only('email', 'name', 'password')); //Retrieving only the email and password data

        $roles = $request['roles']; //Retrieving the roles field
    //Checking if a role was selected
        if (isset($roles)) {

            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();            
            $user->assignRole($role_r); //Assigning role to user
            }
        }  
        Session::flash('success', trans('users.flash_new'));
        return redirect()->route('users.index');
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
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles
        $title = __('users.edit');
        return view('admin.users.edit')->with('roles', $roles)->with('data', $user)->with('title', $title);
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
        $user = User::findOrFail($id); //Get role specified by id

        //Validate name, email and password fields  
        $rules = [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            
         ]; 
         if ($request->password) {
             $rules['password'] = 'min:6|confirmed';
          
         }


            
          $this->validate($request, $rules);


            //$input = $request->only(['name', 'email', 'password']); //Retreive the name, email and password fields
            $input = $request->only(['name', 'email', 'password']); //Retreive the name, email and password fields
            if (empty($input['password'])) {

                $input = array_except($input, array('password'));
            }

            $roles = $request['roles']; //Retreive all roles
            $user->fill($input)->save();
    
            if (isset($roles)) {        
                $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
            }        
            else {
                $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
            return redirect()->route('users.index');

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
        $user = User::find($id);
        $user->delete();
        Session::flash('success', trans('users.flash_delete'));
        return redirect()->route('users.index');
    }
}
