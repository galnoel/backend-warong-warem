<?php

namespace App\Http\Controllers;

use App\Models\reservations;
use App\Http\Requests\StorereservationsRequest;
use App\Http\Requests\UpdatereservationsRequest;
use Illumnate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservationsController extends Controller
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
    public function store(StorereservationsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(reservations $reservations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reservations $reservations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatereservationsRequest $request, reservations $reservations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reservations $reservations)
    {
        //
    }
    function createReservation(Request $req){
        //$customerId = Auth::id();
        //$customer_id = auth()->user()->customer_id;

        $reservation = new Reservations();
        //$reservation->customer_id = $customer_id;
        $reservation->customer_id = $req->input("customer_id");
        $reservation->number_of_people = $req->input("number_of_people");
        $reservation->type = $req->input("type");
        $reservation->date = $req->input("date");
        $reservation->time = $req->input("time");
        $reservation->save();

        return $reservation;


    }
}
