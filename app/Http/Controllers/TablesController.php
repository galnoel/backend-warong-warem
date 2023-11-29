<?php

namespace App\Http\Controllers;

use App\Models\tables;
use App\Http\Requests\StoretablesRequest;
use App\Http\Requests\UpdatetablesRequest;

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

    function tableStatusForWaiters() {
        $tables = tables::all();
        $tableStatusForWaiters = [];
        foreach ($tables as $table) {
            if ($table->status === 'pending') {
                $waiter = $table->waiter;
            if ($waiter){
                $tableStatusForWaiters[$waiter->id][] = [
                    'table_type' => $table->table_type, 
                    'status' => $table->status,
                    'customer_name' => $table->customer_name, 
                    'update_button' => true, 
                ];
            }  
        }
    }

        return $tableStatusForWaiters;
}
    
    function updateTableStatus($request, tables $tables) {
        $tableType = $request->input('table_type');
        $updatedStatus = $request->input('status'); 

        $table = tables::where('table_type', $tableType)->first();
    
        if ($table) {
            if ($updatedStatus === 'confirm' || $updatedStatus === 'reject') {
                $table->status = $updatedStatus;
                $table->save();
            } else {
            }
        }
    }
}