<?php

namespace App\Http\Controllers;

use App\Models\tables;
use App\Http\Requests\StoretablesRequest;
use App\Http\Requests\UpdatetablesRequest;
use Illuminate\Support\Facades\Validator;
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
    
    public function updateStatus(Request $request, $id)
        {
            $tables = Tables::find($id);
            //$reservation->waiter_id = Auth::id(); // assuming the waiter is currently authenticated
            $tables->is_active = $request->is_active; // new status ('approved' or 'rejected')
            $tables->save();
        
            return $tables;
        }
  
        public function updateCapacity(Request $request, $id)
        {
            $tables = Tables::find($id);
            $tables->capacity = $request->capacity; 
            $tables->save();
        
            return $tables;
        }
    }