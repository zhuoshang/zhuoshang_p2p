<?php namespace App\Http\Controllers;
use App\Debt;
use App\DebtBuyList;
use App\DebtBuy;
use App\Quotation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;;
use DB;


/*
**Author:tianling
**createTime:15/3/19 下午3:12
*/
class DebtController extends Controller{

    public function debtIndex() {
        return view('zsmobile.index');
    }

    public function debtList(){

        $debts = DebtBuy::where('uid','=','1')->get();
//        $debts = DeBtBuy::all();
//
//        var_dump($debts);
//        die;

        $debtData = array();

        $now = time();

        foreach($debts as $debt){

            //计算进度时间
            $bondLoading = $now - $debt->debt->add_time;

            $bondLoading = ceil($bondLoading/(60*60)/24);

            //盈亏情况判断
            switch($debt->debt->move){
                case 0:
                    $move = '趋平';
                    break;

                case 1:
                    $move = '盈利';
                    break;

                case 2:
                    $move = '亏损';
                    break;
            }

            if($debt->debt->status == 0){
                $status = '未缴';
            }else{
                $status = '已缴';
            }

            $earn = $debt->total_buy*(1+$debt->debt->interest/100);

            $debtData[] = array(
                'bondLoading'=>$bondLoading,
                'continuousTime'=>$debt->dates,
                'netWorth'=>$debt->debt->net_value,
                'bondValue'=>$debt->debt->total,
                'interest'=>$debt->debt->interest,
                'movements'=>$move,
                'debt'=>$status,
                'voteMoney'=>$debt->total_buy,
                'earnMoney'=>$earn

            );


        }

//        var_dump($debtData);
//        die;
        $data = array(
            'status'=>200,
            'msg'=>'ok',
            'data'=>$debtData
        );

        $data = json_encode($data);

        echo $data;
    }


    public function monthDebtList(Request $request){

        $month = $request->input('month');

        if($month == ''){

            $this->throwERROE(400,'关键参数不得为空');

        }


        $debts = DB::table('debtBuy')
            ->join('debt','debtBuy.did','=','debt.id')
            ->join('debtBuyList','debtBuy.id','=','debtBuyList.bid')
            ->where('debtBuy.uid','=',1)
            ->where('debtBuyList.month','=',$month)
            ->get();

        $dataArray = array();
        $now = time();

        foreach($debts as $debt){

            //计算进度时间
            $bondLoading = $now - $debt->add_time;
            $bondLoading = ceil($bondLoading/(60*60)/24);

            //盈亏情况判断
            switch($debt->move){
                case 0:
                    $move = '趋平';
                    break;

                case 1:
                    $move = '盈利';
                    break;

                case 2:
                    $move = '亏损';
                    break;
            }

            if($debt->status == 0){
                $status = '未缴';
            }else{
                $status = '已缴';
            }

            $earn = $debt->total_buy*(1+$debt->interest/100);

            $dataArray[] = array(
                'bondLoading'=>$bondLoading,
                'continuousTime'=>$debt->dates,
                'netWorth'=>$debt->net_value,
                'bondValue'=>$debt->total,
                'interest'=>$debt->interest,
                'movements'=>$move,
                'debt'=>$status,
                'voteMoney'=>$debt->total_buy,
                'earnMoney'=>$earn
            );

        }

        echo json_encode(
            array(
                'status'=>200,
                'msg'=>'ok',
                'data'=>$dataArray
            )
        );

        exit();


    }



    private function throwERROE($code,$msg){
        echo json_encode(array(
            'status'=>$code,
            'msg'=>$msg,
            'data'=>''
        ));

        exit();
    }



}