<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use JWTAuth;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $users)
    {
        //
    }
    function register(Request $req){
        $validatedData = $req -> validate([
            'name'=> 'required',
            'email'=> 'required|email:dns|unique:Users',
            'password'=> 'required|min:8',
            'role'=>'required',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

//        return $customers;
        return response()->json(['message' => 'User signed up successfully', 'user' => $validatedData]);
        
    }

    /*function login(Request $req){
        $users=Users::where("email", $req->email)->first();
        if(!$users || !Hash::check($req->password, $users->password)){
            return ["Error"=> "Email or password not matched"];
        }

        return $users;
    }*/
    // public function login(LoginRequest $request) {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $token = $user->createToken('authToken')->plainTextToken;
    //         //$token = $user->createToken('main')->plainTextToken;


    //         return response()->json(['token' => $token], 200);
    //     }

    //     return response()->json(['message' => 'Unauthorized'], 401);
    // }
    public function login(LoginRequest $request)
{
    $credentials = $request->only('email', 'password');

    if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return response()->json(['token' => $token]);
}

    public function userRole(Request $request) {
        $role = $request->user()->role; // Access the role directly from the user model

        return response()->json(['role' => $role]);
    }

    public function logout(Request $request)
{
    try {
        JWTAuth::invalidate($request->token);
        return response()->json(['message' => 'Successfully logged out']);
    } catch (JWTException $exception) {
        return response()->json(['error' => 'Failed to logout'], 500);
    }
}

}