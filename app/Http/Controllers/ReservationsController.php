<?php

namespace App\Http\Controllers;

use App\Models\reservations;
use App\Http\Requests\StorereservationsRequest;
use App\Http\Requests\UpdatereservationsRequest;
use Illumnate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reservations = DB::table('reservations')
        ->select('users.name', 'users.email', 'users.id','reservations.*')
        ->join('users', 'reservations.customer_id', '=', 'users.id')
        //->groupBy('reservations.id')
        ->get();

        return response()->json($reservations);
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
        reservations::create($request->validated());

        return $request;
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
    /*function createReservation(Request $req){
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


    }*/
    public function createReservation(Request $request)
    {
        $validatedData = $request->validate([
            'number_of_people'=>'required',
            'type'=> 'required |string|in:regular,vip,outdoor,VIP,Regular,Outdoor,Full ',
            'date'=> 'required|date|after_or_equal:today',
            'time'=> 'required'
        ]);
        $validatedData['customer_id'] = auth()->user()->id;
        $reservations = reservations::create($validatedData);
        return $reservations;
    }

    public function display_customer($id){
        $data = Reservations::find($id);
        $data = reservations::select('customer_id', 'date', 'time', 'status', 'created_at')->get();

        return $data;
        }
    
    public function updateStatus(Request $request, $id)
        {
            $reservation = Reservations::find($id);
            //$reservation->waiter_id = Auth::id(); // assuming the waiter is currently authenticated
            $reservation->status = $request->status; // new status ('approved' or 'rejected')
            $reservation->save();
        
            return $reservation;
        }
    
    public function updateNotes(Request $request, $id)
        {
            $reservation = Reservations::find($id);
            //$reservation->waiter_id = Auth::id(); // assuming the waiter is currently authenticated
            $reservation->notes = $request->notes; // new status ('approved' or 'rejected')
            $reservation->save();
        
            return $reservation;
        }
    public function updateTable(Request $request, $id)
        {
            $reservation = Reservations::find($id);
            //$reservation->waiter_id = Auth::id(); // assuming the waiter is currently authenticated
            $reservation->table_id = $request->table_id; // new status ('approved' or 'rejected')
            $reservation->save();
        
            return $reservation;
        }

        public function reschedule(Request $request, $id)
        {
            $reservation = Reservations::find($id);
            //$reservation->waiter_id = Auth::id(); // assuming the waiter is currently authenticated
            $reservation->date = $request->date;
            $reservation->time = $request->time;
            $reservation->save();
        
            return $reservation;
        }
        
}
