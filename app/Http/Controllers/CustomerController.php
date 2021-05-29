<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Customers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customers::all();
        return view('pages.customers', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.new-customer', ['accounts' => Accounts::all()]);
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
                'fname' => 'required',
                'lname' => 'required',
                'phone' => 'required',
                'address' => 'required',
            );
            $validatedData = Validator::make($request->all(), $validate);
            if ($validatedData->fails()) {
                return $validatedData->errors();
            } else {
                // make customer dont exist by id card and account id
                foreach ($_POST['account'] as $k => $value) {
                    $code = $_POST['account'][$k];
                    if (DB::table('customer_accounts')->where('account', $code)->where('idcard', $request->idcard)->count() > 0) {
                        Session::flash('error', 'Error, Customer Already Created');
                        return view('pages.new-customer',['accounts' => Accounts::all()]);
                    }
                }


                $requestData['fname'] = $request->fname;
                $requestData['lname'] = $request->lname;
                $requestData['phone'] = $request->phone;
                $requestData['address'] = $request->address;
                $requestData['createdby'] = Auth::id();

                if ($inserId = DB::table('customers')->insertGetId($requestData)) {
                    $accoutData = [];
                    foreach ($_POST['account'] as $k => $value) {
                        $accoutData[] = [
                            'account' => $_POST['account'][$k],
                            'amount' => $_POST['amount'][$k],
                            'idcard' => $_POST['idcard'],
                            'acc_number' => $this->getAccountCode($_POST['account'][$k]).'300020008'.$inserId,
                            'customer_id' => $inserId
                        ];
                    }
                    DB::table('customer_accounts')->insert($accoutData);

                    Session::flash('message', 'Success, Record Inserted');
                    return view('pages.new-customer',['accounts' => Accounts::all()]);
                }
            }
        } catch (\Exception $e) {
            Session::flash('error', 'error occured'.$e);
            return view('pages.new-customer',['accounts' => Accounts::all()]);
        }
    }

    protected  function getAccountCode($accountId)
    {
        return Accounts::where('id', $accountId)->first()->code;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'customer' => Customers::where('id', $id)->first(),
            'account_numbers' => DB::table('customer_accounts as c')->join('accounts as a', 'c.account','=','a.id')->where('customer_id', $id)->get()
        ];
        return view('pages.show-customer', $data);
    }

    public function statement($id)
    {
        return view('pages.show-customer-statement');
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

    public function new_customer(Request $request)
    {
        return response()->json([
            'message' => 'record Inserted love',
        ], 401);
    }
}
