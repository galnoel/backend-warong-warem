<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
    public function show(users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, users $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(users $users)
    {
        //
    }
    function register(Request $req){
        $validatedData = $req -> validate([
            'name'=> 'required',
            'email'=> 'required|email:dns|unique:users',
            'password'=> 'required|min:8',
            'role'=>'required',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        users::create($validatedData);

//        return $customers;
        return response()->json(['message' => 'User signed up successfully', 'user' => $validatedData]);
        
    }

    function login(Request $req){
        $users=users::where("email", $req->email)->first();
        if(!$users || !Hash::check($req->password, $users->password)){
            return ["Error"=> "Email or password not matched"];
        }

        return $users;
    }
}
