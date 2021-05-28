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
        return view('pages.customers',['customers'=> $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.new-customer',['accounts' => Accounts::all()]);
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
                'fullname' => 'required',
                'transportType' => 'required',
            );
            $validatedData = Validator::make($request->all(), $validate);
            if ($validatedData->fails()) {
                return $validatedData->errors();
            } else {

                foreach ($_POST['name'] as $k => $value) {
                    $name  = $_POST['name'][$k]; $code = $_POST['code'][$k];
                    if(DB::table('accounts')->where('name',$name)->where('code', $code)->count() > 0){
                        Session::flash('message', 'Account Already Created');
                        return view('pages.new-customer');
                    }
                }
    
                $requestData = [];
                foreach ($_POST['account'] as $k => $value) {
                    $requestData[] = [
                        'createdby' => Auth::id(),
                        'account' => $_POST['account'][$k],
                        'amount' => $_POST['amount'][$k],
                        'code' => $_POST['code'][$k],       
                    ];
                }
    
                if (DB::table('accounts')->insert($requestData)) {
                    Session::flash('message', 'This is a message!'); 
                    return view('pages.accounts', ['accounts' => Accounts::all()]);
                }

            }

        } catch (\Exception $e) {
            return response()->json(
                ['status' => 200, 'message' => 'error occured', 'error message' => $e]
            );
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
        return view('pages.show-customer');
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

    public function new_customer(Request $request){
        return response()->json([
            'message' => 'record Inserted love',
        ], 401);
    }
}
