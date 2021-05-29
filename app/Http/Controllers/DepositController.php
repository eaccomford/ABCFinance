<?php

namespace App\Http\Controllers;

use App\Models\Deposit_notes;
use App\Models\Deposits;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DepositController extends Controller
{
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
            );
            $validatedData = Validator::make($request->all(), $validate);
            if ($validatedData->fails()) {
                return response()->json(['error' => $validatedData->errors(), 'info' => 'There were validation errors'], 401);
            } else {
                $requestData['acc_no'] = $request->acc_no;
                $requestData['date'] = $request->date;
                $requestData['total'] = $request->total;
                $requestData['createdby'] = Auth::id();

                if ($inserId = DB::table('deposits')->insertGetId($requestData)) {
                    
                    DB::table('Deposit_notes')->insert($this->processBankNotes($_POST, $inserId));
                    return response()->json(['res' => 1, 'info' => 'success, record created'], 201);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['res' => 0, 'info' => 'error, record not saved ' . $e], 401);
        }
    }

    protected function processBankNotes($post, $inserId)
    {
        $accoutData = [];
        if($_POST['qty200'] != ''){
            $accoutData[] = [
                'deposit_id' => $inserId,
                'note' => $_POST['note200'],
                'qty' => $_POST['qty200']
            ];
        }
        if($_POST['qty100'] != ''){
            $accoutData[] = [
                'deposit_id' => $inserId,
                'note' => $_POST['note100'],
                'qty' => $_POST['qty100']
            ];
        }
        if($_POST['qty50'] != ''){
            $accoutData[] = [
                'deposit_id' => $inserId,
                'note' => $_POST['note50'],
                'qty' => $_POST['qty50']
            ];
        }
        if($_POST['qty20'] != ''){
            $accoutData[] = [
                'deposit_id' => $inserId,
                'note' => $_POST['note20'],
                'qty' => $_POST['qty20']
            ];
        }
        if($_POST['qty10'] != ''){
            $accoutData[] = [
                'deposit_id' => $inserId,
                'note' => $_POST['note10'],
                'qty' => $_POST['qty10']
            ];
        }
        if($_POST['qty5'] != ''){
            $accoutData[] = [
                'deposit_id' => $inserId,
                'note' => $_POST['note5'],
                'qty' => $_POST['qty5']
            ];
        }
        if($_POST['qty2'] != ''){
            $accoutData[] = [
                'deposit_id' => $inserId,
                'note' => $_POST['note2'],
                'qty' => $_POST['qty2']
            ];
        }
        if($_POST['qty1'] != ''){
            $accoutData[] = [
                'deposit_id' => $inserId,
                'note' => $_POST['note1'],
                'qty' => $_POST['qty1']
            ];
        }

        return $accoutData;
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

    public function check_deposit($accno)
    {
        $customer_accounts = DB::table('customer_accounts')->where('acc_number', $accno)->orderBy('id', 'desc')->take(5)->get();
        if (count($customer_accounts) < 1) {
            return response()->json([
                'res' => 0,
                'info' => 'No Record Found'
            ], 200);
        }
        $deposits = DB::table('deposits')->where('acc_no', $accno)->orderBy('id', 'desc')->take(5)->get();
        $accountInfo = DB::table('customers as c')
            ->join('customer_accounts as a', 'c.id', '=', 'a.customer_id')
            ->join('accounts as m', 'm.id', '=', 'a.account')
            ->where('a.acc_number', $accno)->first();

        $totalDeposits = DB::table('deposits')->where('acc_no', $accno)->sum('total');
        $data = [
            'totalDeposits' => $totalDeposits,
            'deposits' => $deposits,
            'accountInfo' => $accountInfo
        ];

        return response()->json([
            'info' => 'success',
            'data' => $data,
            'res' => 1,
        ], 201);
    }
}
