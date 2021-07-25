<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
        ]);
        if ($v->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->assignRole(["User Normal"]);

        return response()->json(['status' => 'success'], 200);
    }
    /**
     * Login user and return a token
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials, ['exp' => Carbon::now()->addHours(1)->timestamp])) {
            return response()->json([
                'status' => 'success',
                'access_token' => $token,
                'type_token' => 'Bearer',
                'expires_in' => auth()->factory()->getTTL() * 1 .'mn',
            ], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }
    /**
     * Logout User
     */
    public function logout()
    {
        $this->auth()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    /**
     * Get authenticated user
     */
    public function user(Request $request)
    {
        $datas = User::with('roles','roles.permissions')->find(Auth::user()->id);
        $user = [
            'id' => $datas->id,
            'name' => $datas->name,
            'email' => $datas->email,
        ];

        $roles = [
            'id' => $datas->roles[0]->id,
            'name' => $datas->roles[0]->name
        ];
        
        foreach ($datas->roles[0]->permissions as $i => $p){
            $permissions[] = $p->name;
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
        ], 200);
    }
    /**
     * Refresh JWT token
     */
    public function refresh()
    {
        if ($token = $this->auth()->refresh()) {
            return response()->json([
                'status' => 'success',
                'access_token' => $token,
                'type_token' => 'Bearer',
                'expires_in' => auth()->factory()->getTTL() * 6,
            ], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
}
