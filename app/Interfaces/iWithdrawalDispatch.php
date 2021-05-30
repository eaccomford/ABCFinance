<?php 
namespace App\Interfaces;

interface iWithdrawalDispatch{

    public function startWithdrawal($account_number);
    public function check($account_number);

}