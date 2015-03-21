<?php namespace App\Http\Controllers;
use App\Debt;
/*
**Author:tianling
**createTime:15/3/19 下午3:12
*/
class DebtController extends Controller{

    public function debtData(){
        echo "ok,boy";


        $debts = Debt::all();

        var_dump($debts);
    }
}