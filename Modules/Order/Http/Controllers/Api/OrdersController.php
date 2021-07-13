<?php

namespace Modules\Order\Http\Controllers\Api;

use App\Http\Controllers\HyperPay;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Entities\User;
use Modules\Cart\Entities\Cart;
use Modules\Nutritionist\Entities\Nutritionist;
use Modules\Order\Entities\FitnessClubOrder;
use Modules\Order\Entities\NutritionistOrder;
use Modules\Order\Entities\OrderModifier;
use Modules\Order\Entities\OrderResturant;
use Modules\Order\Entities\OrderResturantCart;
use Modules\Order\Entities\TrainerOrder;
use Modules\Trainer\Entities\Trainer;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function resturantOrder(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('rest_id','meal_id'=>'required','quantity'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $Jwt = getallheaders()['Jwt'];
        $result = User::where('jwt',$Jwt)->first();
        if ($result == 'false') {
            return response()->json([
                'status' => false,
                'message' => 'user not found',
                'data' => [],
                'errors' => [],
            ], 404);
        }
        $rand=mt_rand(100000, 999999);
        $payment=new HyperPay();
        $checkOut=$payment->request_checkoutId($request->total,$result,$rand);
        $order=OrderResturant::create(
            array(
                'user_id' => $result->id,
                'resturant_id' => $request->rest_id,
                'total'=>$request->total,
                'order_number'=>$rand,
                'transaction_id'=>$checkOut,
            )
        );
        $meals=explode(',',$request->meal_id);
        $quantities=explode(',',$request->quantity);
        $modifiers=explode(',',$request->modifier);
        for($i=0; $i<count($meals);$i++){
            OrderResturantCart::create(
                array(
                    'meal_id'=>$meals[$i],
                    'order_id'=>$order->id,
                    'quantity'=>$quantities[$i],
                )
            );
        }
        for($i=0; $i<count($modifiers);$i++){
            OrderModifier::create(
                array(
                    'modifier_id'=>$modifiers[$i],
                    'order_id'=>$order->id,
                )
            );
        }

        Cart::whereIn('meal_id',$meals)->delete();


        $order['order_id']=$order->id;
        $order['dept_id']="1";
        return response()->json([
            'status' => true,
            'message' => 'Order made Successfully',
            'data' => $order,
            'checkout'=>$checkOut,
            'errors' => [],
        ], 201);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function subscriptionOrder(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('club_id','subscription_id'=>'required','total'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $Jwt = getallheaders()['Jwt'];
        $result = User::where('jwt',$Jwt)->first();
        if ($result == 'false') {
            return response()->json([
                'status' => false,
                'message' => 'user not found',
                'data' => [],
                'errors' => [],
            ], 404);
        }
        $rand=mt_rand(100000, 999999);
        $payment=new HyperPay();
        $checkOut=$payment->request_checkoutId($request->total,$result,$rand);
        $fit=FitnessClubOrder::create(
            array(
                'user_id' => $result->id,
                'fitness_club_id' => $request->club_id,
                'subscription_id'=> $request->subscription_id,
                'total'=>$request->total,
                'order_number'=>$rand,
                'transaction_id'=>$checkOut,
            )
        );




        $order['order_id']=$fit->id;
        $order['dept_id']="2";

        return response()->json([
            'status' => true,
            'message' => 'Order made Successfully',
            'data' => $order,
            'checkout'=>$checkOut,
            'errors' => [],
        ], 201);

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function nutritionistOrder(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('nutritionist_id','total'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $Jwt = getallheaders()['Jwt'];
        $result = User::where('jwt',$Jwt)->first();
        if ($result == 'false') {
            return response()->json([
                'status' => false,
                'message' => 'user not found',
                'data' => [],
                'errors' => [],
            ], 404);
        }
        $rand=mt_rand(100000, 999999);
        $payment=new HyperPay();
        $checkOut=$payment->request_checkoutId($request->total,$result,$rand);
        $nutri=NutritionistOrder::create(
            array(
                'user_id' => $result->id,
                'nutritionist_id' => $request->nutritionist_id,
                'total'=>$request->total,
                'order_number'=>$rand,
                'transaction_id'=>$checkOut,
            )
        );

        $busy=Nutritionist::where('id', $request->nutritionist_id)->first();
        $busy->is_busy='1';
        $busy->save();


        $order['order_id']=$nutri->id;
        $order['dept_id']="3";
        return response()->json([
            'status' => true,
            'message' => 'Order made Successfully',
            'data' => $order,
            'checkout'=>$checkOut,
            'errors' => [],
        ], 201);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function trainerOrder(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('trainer_id','total'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $Jwt = getallheaders()['Jwt'];
        $result = User::where('jwt',$Jwt)->first();
        if ($result == 'false') {
            return response()->json([
                'status' => false,
                'message' => 'user not found',
                'data' => [],
                'errors' => [],
            ], 404);
        }
        $rand=mt_rand(100000, 999999);
        $payment=new HyperPay();
        $checkOut=$payment->request_checkoutId($request->total,$result,$rand);
        $trainer=TrainerOrder::create(
            array(
                'user_id' => $result->id,
                'trainer_id' => $request->trainer_id,
                'total'=>$request->total,
                'order_number'=>$rand,
                'transaction_id'=>$checkOut,
            )
        );

        $busy=Trainer::where('id', $request->trainer_id)->first();
        $busy->is_busy='1';
        $busy->save();

        $payment=new HyperPay();
        $checkOut=$payment->request_checkoutId($request->total,$result,$rand);
        $order['order_id']=$trainer->id;
        $order['dept_id']="4";
        return response()->json([
            'status' => true,
            'message' => 'Order made Successfully',
            'data' => $order,
            'checkout'=>$checkOut,
            'errors' => [],
        ], 201);

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function paymentCallBack(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('order_id'=>'required','dept_id'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        if($request->dept_id==1){
            $payment          = new HyperPay();
            $getPaymentStatus = json_decode($payment->get_payment_status($request->order_id));
            if ($getPaymentStatus->result->code == "000.100.112"){
                $transaction =  OrderResturant::where('transaction_id',$getPaymentStatus->merchantTransactionId)->first();
                if ($transaction){
                    if ($transaction->type == 0){
                        $order =  OrderResturant::find($transaction->order_id);
                        $order->update(['patment_type' => 0]);
                    }else{
                        $order =  OrderResturant::find($transaction->order_id);
                        $order->update(['payment_status' => 1]);
                    }
                    // return response()->json([
                    //     'status' => true,
                    //     'message' => 'so',
                    //     'data' => [],
                    //     'errors' => [],
                    //     ['payment_status' => true],
                    // ], 201);
                    $payment->checkPayment($transaction->transaction_id);
                }
                // return response()->json([
                //     'status' => false,
                //     'message' => 'something went wrong',
                //     'data' => [],
                //     'errors' => [],
                // ], 404);
                $payment->checkPayment($transaction->transaction_id);
            }
            // return response()->json([
            //     'status' => true,
            //     'message' => 'so',
            //     'data' => [],
            //     'errors' => [],
            //     ['payment_status' => false],
            // ], 404);
            $payment->checkPayment($transaction->transaction_id);
        }elseif($request->dept_id==2) {
            $payment = new HyperPay();
            $getPaymentStatus = json_decode($payment->get_payment_status($request->order_id));
            if ($getPaymentStatus->result->code == "000.100.112") {
                $transaction = FitnessClubOrder::where('transaction_id', $getPaymentStatus->merchantTransactionId)->first();
                if ($transaction) {
                    if ($transaction->type == 0) {
                        $order = FitnessClubOrder::find($transaction->order_id);
                        $order->update(['patment_type' => 0]);
                    } else {
                        $order = FitnessClubOrder::find($transaction->order_id);
                        $order->update(['payment_status' => 1]);
                    }
                    // return response()->json([
                    //     'status' => true,
                    //     'message' => 'so',
                    //     'data' => [],
                    //     'errors' => [],
                    //     ['payment_status' => true],
                    // ], 201);
                    $payment->checkPayment($transaction->transaction_id);
                }
                // return response()->json([
                //     'status' => false,
                //     'message' => 'something went wrong',
                //     'data' => [],
                //     'errors' => [],
                // ], 404);
                $payment->checkPayment($transaction->transaction_id);
            }
            // return response()->json([
            //     'status' => true,
            //     'message' => 'so',
            //     'data' => [],
            //     'errors' => [],
            //     ['payment_status' => false],
            // ], 404);
            $payment->checkPayment($transaction->transaction_id);
        }elseif($request->dept_id==3) {
            $payment = new HyperPay();
            $getPaymentStatus = json_decode($payment->get_payment_status($request->order_id));
            if ($getPaymentStatus->result->code == "000.100.112") {
                $transaction = NutritionistOrder::where('transaction_id', $getPaymentStatus->merchantTransactionId)->first();
                if ($transaction) {
                    if ($transaction->type == 0) {
                        $order = NutritionistOrder::find($transaction->order_id);
                        $order->update(['patment_type' => 0]);
                    } else {
                        $order = NutritionistOrder::find($transaction->order_id);
                        $order->update(['payment_status' => 1]);
                    }
                    // return response()->json([
                    //     'status' => true,
                    //     'message' => 'so',
                    //     'data' => [],
                    //     'errors' => [],
                    //     ['payment_status' => true],
                    // ], 201);
                    $payment->checkPayment($transaction->transaction_id);
                }
                // return response()->json([
                //     'status' => false,
                //     'message' => 'something went wrong',
                //     'data' => [],
                //     'errors' => [],
                // ], 404);
                $payment->checkPayment($transaction->transaction_id);
            }
            // return response()->json([
            //     'status' => true,
            //     'message' => 'so',
            //     'data' => [],
            //     'errors' => [],
            //     ['payment_status' => false],
            // ], 404);
            $payment->checkPayment($transaction->transaction_id);
        }else{
            $payment = new HyperPay();
            $getPaymentStatus = json_decode($payment->get_payment_status($request->order_id));
            if ($getPaymentStatus->result->code == "000.100.112") {
                $transaction = TrainerOrder::where('transaction_id', $getPaymentStatus->merchantTransactionId)->first();
                if ($transaction) {
                    if ($transaction->type == 0) {
                        $order = TrainerOrder::find($transaction->order_id);
                        $order->update(['patment_type' => 0]);
                    } else {
                        $order = TrainerOrder::find($transaction->order_id);
                        $order->update(['payment_status' => 1]);
                    }
                    // return response()->json([
                    //     'status' => true,
                    //     'message' => 'so',
                    //     'data' => [],
                    //     'errors' => [],
                    //     ['payment_status' => true],
                    // ], 201);
                    $payment->checkPayment($transaction->transaction_id);
                }
                // return response()->json([
                //     'status' => false,
                //     'message' => 'something went wrong',
                //     'data' => [],
                //     'errors' => [],
                // ], 404);
                $payment->checkPayment($transaction->transaction_id);
            }
            // return response()->json([
            //     'status' => true,
            //     'message' => 'so',
            //     'data' => [],
            //     'errors' => [],
            //     ['payment_status' => false],
            // ], 404);
            $payment->checkPayment($transaction->transaction_id);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function checkPayment(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        // $payment          = new HyperPay();
        return response()->json(HyperPay::checkPayment($request->input('id')), 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function onlinePayment(Request $request)
    {
        $validator  =   Validator::make($request->all(), [
            'amount' => 'required',
            'merchantTransactionId' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $Jwt = getallheaders()['Jwt'];
        $user = User::where('jwt',$Jwt)->first();
        $payment          = new HyperPay();

        if ($user) {
            // return response()->json($payment->payment($request->input('amount'), $request->input('merchantTransactionId'), $user->name, $user->email), 200);
            return response()->json($payment->payment($user,$request->input('amount') , $request->input('merchantTransactionId')), 200);
        } else {
            return response()->json("user_not_found", 400);
        }
    }
}
