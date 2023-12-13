<?php

    namespace App\Http\Controllers;

    use App\Models\reservations;
    use App\Http\Requests\StorereservationsRequest;
    use App\Http\Requests\UpdatereservationsRequest;
    use Illumnate\Support\Facades\Auth;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Tymon\JWTAuth\Facades\JWTAuth; // Import JWTAuth facade (assuming you're using tymon/jwt-auth package)


    class ReservationsController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $reservations = DB::table('reservations')
                ->select('users.name', 'users.email', 'users.id', 'reservations.*')
                ->join('users', 'reservations.customer_id', '=', 'users.id')
                 // Filter reservations by user ID
                ->get();

            return response()->json($reservations);
        }
        public function getUserReservations(Request $request)
        {
            $user = null;

            // Check for JWT token in the request headers
            if ($token = $request->header('Authorization')) {
                $token = str_replace('Bearer ', '', $token);

                // Attempt to authenticate the user using the JWT token
                try {
                    $user = JWTAuth::parseToken()->authenticate();
                } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                    // Handle JWT exceptions here (e.g., token expired, invalid token)
                    return response()->json(['error' => 'Invalid token'], 401);
                }
            }

            if ($user) {
                // Fetch reservations for the authenticated user only
                $reservations = Reservations::where('customer_id', $user->id)->get();
                
                return response()->json($reservations);
            } else {
                // Handle the case where no user is authenticated
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
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
        public function show($id)
        {
            $reservation = Reservations::find($id);
            return $reservation;
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
        function createDummyReservation(Request $req){
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
    //     public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['createReservation']]);
    // }
        public function createReservation_backup(Request $request)
        {
            $validatedData = $request->validate([
                'number_of_people'=>'required',
                'type'=> 'required',
                'date'=> 'required',
                'time'=> 'required'
            ]);
            if (auth()->check()) {
                $validatedData['customer_id'] = auth()->user()->id;
                $reservations = reservations::create($validatedData);
                return $reservations;
            } else {
                // Handle the case where no user is authenticated
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
        }


public function createReservation(Request $request)
{
    $validatedData = $request->validate([
        'number_of_people'=>'required',
        'type'=> 'required',
        'date'=> 'required',
        'time'=> 'required'
    ]);

    $user = null;

    // Check for JWT token in the request headers
    if ($token = $request->header('Authorization')) {
        $token = str_replace('Bearer ', '', $token);

        // Attempt to authenticate the user using the JWT token
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            // Handle JWT exceptions here (e.g., token expired, invalid token)
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }

    if ($user) {
        $validatedData['customer_id'] = $user->id;
        $reservation = Reservations::create($validatedData);
        return $reservation;
    } else {
        // Handle the case where no user is authenticated
        return response()->json(['error' => 'Unauthenticated'], 401);
    }
}


    //     public function createDummyReservation(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'customer_id'=> 'required',
    //         'number_of_people'=>'required',
    //         'type'=> 'required|string|in:regular,vip,outdoor,VIP,Regular,Outdoor,Full',
    //         'date'=> 'required|date|after_or_equal:today',
    //         'time'=> 'required'
    //     ]);

    //     try {
    //         $reservation = Reservations::create($validatedData);
    //         return response()->json($reservation, 201); // Return a JSON response with HTTP status 201 (Created)
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Could not create reservation.'], 500); // Internal Server Error
    //     }
    // }



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
                $reservation->table_id = $request->table_id; 
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
