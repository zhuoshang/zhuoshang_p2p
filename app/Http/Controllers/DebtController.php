<?php namespace App\Http\Controllers;
use App\Debt;
use App\DebtBuyList;

/*
**Author:tianling
**createTime:15/3/19 下午3:12
*/
class DebtController extends Controller{

    public function debtData(){

        $debts = DebtBuyList::where('bid','=','1')->orderBy('month','DESC')->first()->toArray();


        $data = array(
            'status'=>200,
            'msg'=>'',
            'data'=>$debts
        );

        $data = json_encode($data);

        echo $data;
    }
}