<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.accounts', ['accounts' => Accounts::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.new-account');
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

            foreach ($_POST['name'] as $k => $value) {
                if ($_POST['name'][$k] === '' || $_POST['code'][$k] === '') {
                    Session::flash('message', 'Enter Values in the form fields');
                    return view('pages.new-account');
                }
            }

            foreach ($_POST['name'] as $k => $value) {
                $name  = $_POST['name'][$k]; $code = $_POST['code'][$k];
                if(DB::table('accounts')->where('name',$name)->where('code', $code)->count() > 0){
                    Session::flash('message', 'Account Already Created');
                    return view('pages.new-account');
                }
            }

            $requestData = [];
            foreach ($_POST['name'] as $k => $value) {
                $requestData[] = [
                    'createdby' => Auth::id(),
                    'name' => $_POST['name'][$k],
                    'code' => $_POST['code'][$k],
                ];
            }

            if (DB::table('accounts')->insert($requestData)) {
                Session::flash('message', 'This is a message!'); 
                return view('pages.accounts', ['accounts' => Accounts::all()]);
            }


        } catch (\Exception $e) {
            return response()->json(
                ['status' => 200, 'message' => 'error occured', 'error message' => $e]
            );
        }
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
}
