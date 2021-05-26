<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    protected $tranport;
    public function __construct(TrasportController $tranport)
    {
        $this->transport = $tranport;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bookings()
    {
        return response()->json(Booking::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book(Request $request)
    {
        try {
            if (!in_array($request->trasportMode, ['air', 'car', 'train'])) {
                return 'The travel mode you seledted is invalid';
            }

            $validate = array(
                'fullname' => 'required',
                'transportType' => 'required',
            );
            $validatedData = Validator::make($request->all(), $validate);
            if ($validatedData->fails()) {
                return $validatedData->errors();
            } else {
                $requestData['fullname'] = $request->fullname;
                $requestData['transportType'] = $request->transportType;
                $requestData['date'] = date(now());
                $requestData['status'] = 1;
                if (DB::table('booking')->insert($requestData)) {
                    $stratTraveling =  $this->transport->start($request->trasportMode);
                    return response()->json(
                        [
                            'status' => 200,
                            'message' => 'record Inserted',
                            'travelMode' => $stratTraveling
                        ]
                    );
                }
            }
        } catch (\Throwable $th) {
            return response()->json(
                ['status' => 200, 'message' => 'error occured', 'err' => $th]
            );
        }
    }
}
