<?php namespace App\Http\Controllers;
use App\Debt;
use App\FrontUser;
use App\DebtBuyList;
use App\DebtType;
use App\DebtBuy;
use App\Quotation;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Auth;


/*
**Author:tianling
**createTime:15/3/19 下午3:12
*/
class DebtController extends Controller{

    public function debtIndex() {
        return view('zsmobile.index');
    }


    /*
     ** 查询当月购买债券最新数据
     **/
    public function debtList(){

        $now_month = intval(date('m',time()));
        $now_year = intval(date('Y',time()));


        $debts = DebtBuy::where('uid','=','1')
            ->where('buy_month','=',$now_month)
            ->where('buy_year','=',$now_year)
            ->get();

        $debtData = array();

        $now = time();

        //拼当月最新数据数组
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
                'earnMoney'=>$earn,
                'riskMoney'=>$debt->debt->risk_keep

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


    /*
     * 按月查询用户资产最新情况
     **/
    public function monthDebtList(Request $request){

        $month = $request->input('month');
        $year = $request->input('year');


        if($month == '' || $year == ''){

            $this->throwERROE(400,'关键参数不得为空');

        }

        $debts = DB::table('debtBuy')
            ->join('debt','debtBuy.did','=','debt.id')
            ->where('debtBuy.uid','=',1)
            ->where('debtBuy.buy_month','=',$month)
            ->where('debtBuy.buy_year','=',$year)
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
                'earnMoney'=>$earn,
                'riskMoney'=>$debt->risk_keep
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


    /*
     * 获取所有正在发布的基金信息
     **/
    public function debtTable(){
        $debtData = array();

        //获取所有置顶基金
        $topDebt = Debt::where('top','=',1)
            ->orderBy('add_time','DESC')
            ->get();

        $now = time();

        foreach($topDebt as $tops){

            //计算进度时间
            $bondLoading = $now - $tops->add_time;
            $bondLoading = ceil($bondLoading/(60*60)/24);

            $debtData[] = array(
                'bondLoading'=>$bondLoading,
                'newWorth'=>$tops->net_value,
                'interest'=>$tops->interest,
                'boundValue'=>$tops->total,
                'status'=>$tops->top,
                'type'=>array(
                    $tops->debtType->id=>$tops->debtType->name
                ),
                'title'=>$tops->title

            );
        }

        //获取所有未置顶基金
        $normalDebt = Debt::where('top','=',0)
            ->orderBy('add_time','DESC')
            ->get();

        //将未置顶基金追加到置顶基金之后
        foreach($normalDebt as $debt){
            //计算进度时间
            $bondLoading = $now - $debt->add_time;
            $bondLoading = ceil($bondLoading/(60*60)/24);

            $debtData[] = array(
                'bondLoading'=>$bondLoading,
                'newWorth'=>$debt->net_value,
                'interest'=>$debt->interest,
                'boundValue'=>$debt->total,
                'status'=>$debt->top,
                'type'=>array(
                    $debt->debtType->id=>$debt->debtType->name
                ),
                'title'=>$debt->title

            );
        }

        echo json_encode(array(
            'status'=>200,
            'msg'=>'ok',
            'data'=>$debtData
        ));

        exit();
    }


    /*
     ** 抛错函数
     **/
    private function throwERROE($code,$msg){
        echo json_encode(array(
            'status'=>$code,
            'msg'=>$msg,
            'data'=>''
        ));

        exit();
    }



}