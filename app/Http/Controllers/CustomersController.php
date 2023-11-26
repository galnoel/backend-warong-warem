<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Http\Requests\StorecustomersRequest;
use App\Http\Requests\UpdatecustomersRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecustomersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customers $customers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecustomersRequest $request, customers $customers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customers $customers)
    {
        //
    }

    function register(Request $req){
        $customers=new customers;
        $customers->name = $req->input("name");
        $customers->email = $req->input("email");
        $customers->password = Hash::make ($req->input("password"));
        $customers->save();

        return $customers;
    }

    function login(Request $req){
        $customers=customers::where("email", $req->email)->first();
        if(!$customers || !Hash::check($req->password, $customers->password)){
            return ["Error"=> "Email or password not matched"];
        }

        return $customers;
    }
}
