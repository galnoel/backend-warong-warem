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
    
    public function changeCapacity(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'table_name' => 'required|string',
            'new_capacity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get the table
        $table = \App\Models\Tables::where('name', $request->get('tables'))->firstOrFail();

        // Update the capacity
        $table->capacity = $request->get('new_capacity');
        $table->save();

        return response()->json([
            'success' => true,
            'message' => 'Kapasitas tabel berhasil diubah',
        ], 200);
    }
  
    public function changeTableStatus(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'table_id' => 'required|integer',
            'status' => 'required|in:booked,empty',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Get the table
        $table = \App\Models\Tables::findOrfail($request->get('table_id'));

        // Update the status
        $table->status = $request->get('status');
        $table->save();

        return response()->json([
            'success' => true,
            'message' => 'Status tabel berhasil diubah',
            'data' => $table,
        ], 200);
    }
}