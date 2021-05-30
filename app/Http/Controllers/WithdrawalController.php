<?php

namespace App\Http\Controllers;
use App\Models\Withdrawals;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    protected $withdrawalDispatch;

    public function __construct(WithdrawalDispatchController $withdrawalDispatch)
    {
        $this->withdrawalDispatch = $withdrawalDispatch;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdrawals = DB::table('customer_account_vw as c')->join('withdrawals as d', 'd.acc_no', '=', 'c.acc_number')->orderBy('d.id', 'desc')->paginate(10); 
        $data = [
            'withdrawals' => $withdrawals
        ];
        return view('pages.withdrawals',$data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.new-withdrawal');
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
                'amount' => 'required',
                'doneBy' => 'required',
            );
            $validatedData = Validator::make($request->all(), $validate);
            if ($validatedData->fails()) {
                return response()->json(['error' => $validatedData->errors(), 'info' => 'There were validation errors'], 401);
            } else {
                $requestData['acc_no'] = $request->acc_no;
                $requestData['date'] = $request->date;
                $requestData['amount'] = $request->amount;
                $requestData['doneBy'] = $request->doneBy;
                $requestData['createdby'] = Auth::id();

                if ($inserId = DB::table('withdrawals')->insertGetId($requestData)) {
                    return response()->json(['res' => 1, 'info' => 'success, record created'], 201);
                }
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
        $withdrawal = DB::table('customer_account_vw as c')->join('withdrawals as d', 'd.acc_no', '=', 'c.acc_number')->where('d.id', $id)->first(); 
        $data = [
            'withdrawal' => $withdrawal,
        ];
        return view('pages.show-withdrawal', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function check_withdrawal($accno)
    {
        return $this->withdrawalDispatch->check($accno);
    }
}
