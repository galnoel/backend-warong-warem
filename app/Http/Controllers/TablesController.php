<?php

namespace App\Http\Controllers;

use App\Models\tables;
use App\Http\Requests\StoretablesRequest;
use App\Http\Requests\UpdatetablesRequest;
use Illuminate\Http\Request;

class TablesController extends Controller
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
    public function store(StoretablesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(tables $tables)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tables $tables)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetablesRequest $request, tables $tables)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tables $tables)
    {
        //
    }

    function registerTable(Request $req){
        $tables=new tables;
        $tables->type = $req->input("type");
        $tables->capacity = $req->input("capacity");
        $tables->save();

        return $tables;
    }
}
