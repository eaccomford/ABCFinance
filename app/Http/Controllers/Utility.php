<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class Utility extends Controller
{
    public static function accountInfo($account_number)
    {
        return  DB::table('customers as c')
            ->join('customer_accounts as a', 'c.id', '=', 'a.customer_id')
            ->join('accounts as m', 'm.id', '=', 'a.account')
            ->where('a.acc_number', $account_number)->first();
    }
}
