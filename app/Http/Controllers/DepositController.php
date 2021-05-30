<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DepositController extends Controller
{
    protected $depositDdispatch;

    public function __construct(DepositDispatchController $depositDdispatch)
    {
        $this->depositDdispatch = $depositDdispatch;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deposits = DB::table('customer_account_vw as c')->join('deposits as d', 'd.acc_no', '=', 'c.acc_number')->orderBy('d.id', 'desc')->paginate(10); 
        $data = [
            'deposits' => $deposits
        ];
        return view('pages.deposits', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.new-deposit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validate = array(
                'acc_no' => 'required',
                'date' => 'required',
                'total' => 'required',
                'doneBy' => 'required'
            );
            $validatedData = Validator::make($request->all(), $validate);
            if ($validatedData->fails()) {
                return response()->json(['error' => $validatedData->errors(), 'info' => 'There were validation errors'], 401);
            } else {
                // store deposit request
                return $this->depositDdispatch->deposit($request);
            }
        } catch (\Exception $e) {
            return response()->json(['res' => 0, 'info' => 'error, record not saved ' . $e], 401);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deposits = DB::table('customer_account_vw as c')->join('deposits as d', 'd.acc_no', '=', 'c.acc_number')->where('d.id', $id)->first();
        $deposit_notes = DB::table('deposit_notes')->where('deposit_id', $id)->get();
        $data = [
            'deposits' => $deposits,
            'deposit_notes' => $deposit_notes,
        ];
        return view('pages.show-deposit', $data);
    }

  

    public function check_deposit($accno)
    {
        return $this->depositDdispatch->checkDeposit($accno);
    }
}
