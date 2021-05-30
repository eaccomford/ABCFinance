<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Interfaces\iDepositDispatch;

class DepositDispatchController extends Controller implements iDepositDispatch
{
    public function deposit($request)
    {
        $requestData['acc_no'] = $request->acc_no;
        $requestData['date'] = $request->date;
        $requestData['total'] = $request->total;
        $requestData['doneBy'] = $request->doneBy;
        $requestData['createdby'] = Auth::id();

        if ($inserId = DB::table('deposits')->insertGetId($requestData)) {
            DB::table('Deposit_notes')->insert($this->processBankNotes($inserId));
            return response()->json(['res' => 1, 'info' => 'success, deposit record Saved'], 201);
        }else{
            return response()->json(['res' => 0, 'info' => 'Error, depositing faild'], 402);
        }
    }

    public function checkDeposit($accno)
    {
        $customer_accounts = DB::table('customer_accounts')->where('acc_number', $accno)->orderBy('id', 'desc')->take(5)->get();
        if (count($customer_accounts) < 1) {
            return response()->json([
                'res' => 0,
                'info' => 'No Record Found'
            ], 200);
        }
        $deposits = DB::table('deposits')->where('acc_no', $accno)->orderBy('id', 'desc')->take(5)->get();

        $totalDeposits = DB::table('deposits')->where('acc_no', $accno)->sum('total');
        $totalWithdrawal =  DB::table('withdrawals')->where('acc_no', $accno)->sum('amount');
        $data = [
            'totalDeposits' => $totalDeposits,
            'totalWithdrawal' => $totalWithdrawal,
            'deposits' => $deposits,
            'accountInfo' => Utility::accountInfo($accno)
        ];

        return response()->json([
            'info' => 'success',
            'data' => $data,
            'res' => 1,
        ], 201);
    }

    protected function processBankNotes($inserId)
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

    
}

