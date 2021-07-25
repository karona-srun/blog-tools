<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id','DESC')->get();
        return response()->json(['users' => $users],200);
        
        // $data = User::orderBy('id','DESC')->paginate(5);
        // return view('users.index',compact('data'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name')->all();
        // return view('users.create',compact('roles'));
        return response()->json([
            'roles' => $roles
        ], 200);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:password_confirmation',
            'roles' => 'required'
        ]);

        if ($validator->fails()) {    
            return response()->json([
                'status' => 'fail',
                'message' => 'User is failed'
            ], 411);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $user
        ], 200);

        // return redirect()->route('users.index')
        //                 ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json(['users' => $user], 200);
        // return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name')->all();
        $userRoles = $user->roles->pluck('name')->all();
        return response()->json([
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ], 200);
        // return view('users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $request->id,
            'password' => 'same:password_confirmation',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($request->id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $request->id)->delete();
        
        $user->assignRole($request->roles);
    
        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'data' => $user
        ], 200);
        // return redirect()->route('users.index')
        //                 ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
        ], 200);
        // return redirect()->route('users.index')
        //                 ->with('success','User deleted successfully');
    }
}