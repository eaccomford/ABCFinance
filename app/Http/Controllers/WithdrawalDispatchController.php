<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Interfaces\iWithdrawalDispatch;

class WithdrawalDispatchController extends Controller implements iWithdrawalDispatch
{
  
    public function startWithdrawal($account_number)
    {
        return 'You are travelling by Train';
    }

    public function check($account_number)
    {
        $customer_accounts = DB::table('customer_accounts')->where('acc_number', $account_number)->orderBy('id', 'desc')->take(5)->get();
        if (count($customer_accounts) < 1) {
            return response()->json([
                'res' => 0,
                'info' => 'No Record Found'
            ], 200);
        }
        $withdrawals = DB::table('withdrawals')->where('acc_no', $account_number)->orderBy('id', 'desc')->take(5)->get();

        $totalDeposit =  DB::table('deposits')->where('acc_no', $account_number)->sum('total');
        $totalWithdrawal =  DB::table('withdrawals')->where('acc_no', $account_number)->sum('amount');
        $data = [
            'totalDeposit' => $totalDeposit,
            'totalWithdrawal' => $totalWithdrawal,
            'withdrawals' => $withdrawals,
            'accountInfo' => Utility::accountInfo($account_number) 
        ];

        return response()->json([
            'info' => 'success',
            'data' => $data,
            'res' => 1,
        ], 201);
    }


}
