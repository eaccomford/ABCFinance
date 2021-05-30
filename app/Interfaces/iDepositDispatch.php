<?php 
namespace App\Interfaces;

interface iDepositDispatch{
    public function deposit($request);
    public function checkDeposit($accno);
}