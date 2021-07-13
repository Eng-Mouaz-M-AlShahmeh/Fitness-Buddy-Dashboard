<?php

namespace Modules\Order\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\FitnessClub\Entities\FitnessClub;
use Modules\Order\Entities\FitnessClubOrder;
use Modules\Order\Entities\NutritionistOrder;
use Modules\Order\Entities\OrderModifier;
use Modules\Order\Entities\OrderResturant;
use Modules\Order\Entities\OrderResturantCart;
use Modules\Order\Entities\TrainerOrder;
use Modules\Subscription\Entities\Subscription;
use Modules\Order\Http\Requests\OrderClubsRequest;
use Modules\Order\Http\Requests\OrderRestaurantsRequest;

use DB;
use DateTime;
use Carbon\Carbon;
use PDF;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function resturantsIndex()
    {
        $orders=OrderResturant::orderBy('id','desc')->get();
        return view('order::resturants.index',compact('orders'));
    }


    // filter search restaurants
    
    public function resturantsDaily()
    {
        $orders=OrderResturant::orderBy('id','desc')->get();
        return view('order::resturants.daily',compact('orders'));
    }


    // view restaurant order monthly
    public function resturantsMonthly()
    {
        $orders=OrderResturant::orderBy('id','desc')->get();
        foreach ($orders as $object) {
            if( $object->resturant['plan_id'] = '1') {
                $orders=OrderResturant::orderBy('id','desc')->get();
                return view('order::resturants.monthly',compact('orders'));
            }else{
                $orders=OrderResturant::orderBy('id','desc')->get();
                return 'No Results';
                
            }
        }
        
    }
    
    
    // edit restaurant order monthly form

    public function editMonthly($id)
    {
        $order=OrderResturant::findOrFail($id);
        return view('order::resturants.editMonthly',compact('order'));
    }


    // update restaurant order monthly form

    public function updateMonthly(OrderRestaurantsRequest $request, $id)
    {
        $order=OrderResturant::findOrFail($id);
        $data = $request->validated();


        if($request->pause_period == "0"){

            //$created_at = new DateTime($order->created_at);
            $subscriptionDays = '30';
            $dateTimeNow = Carbon::now()->toDateTimeString();
            //$suspension_period_difference = $dateTimeNow - $order->created_at;


            $datetime1 = new DateTime($dateTimeNow);
            $datetime2 = new DateTime($order->created_at);
            $interval = $datetime1->diff($datetime2);
            $suspension_days = $interval->format('%a');




            if(is_null($order->updated_at)){
                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '1' ,
                    'ended_at' =>  DB::raw("DATE_ADD(created_at, INTERVAL ".$subscriptionDays." DAY)"),

                ]);
                Toastr::warning('Your Pause Period Finished and Your Subscription is Active Now!','Warning',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.resturants.monthly');
            }else{

                $normalEnd = DB::raw("DATE_ADD(created_at, INTERVAL ".$subscriptionDays." DAY)");


                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '1' ,
                    'ended_at' =>  DB::raw("DATE_ADD(".$normalEnd.", INTERVAL ".$suspension_days." DAY)"),

                ]);


                Toastr::warning('Your Pause Period Finished and Your Subscription is Active Now!','Warning',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.resturants.monthly');

            }




        }elseif($request->pause_period > "0"){

            if(is_null($order->updated_at)){

                $dateTimeNow = Carbon::now()->toDateTimeString();
                $subscriptionDays = '30';
                $normalEnd = DB::raw("DATE_ADD(created_at, INTERVAL ".$subscriptionDays." DAY)");


                $datetime1 = new DateTime($dateTimeNow);
                $datetime2 = new DateTime($order->created_at);
                $interval = $datetime1->diff($datetime2);
                $suspension_days = $interval->format('%a');




                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '0' ,
                    'ended_at' =>  DB::raw("DATE_ADD(".$normalEnd.", INTERVAL ".$request->pause_period." DAY)"),

                ]);


                //$order->update($data);
                Toastr::success('Your Resturant Order has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.resturants.monthly');






            }else{
                $dateTimeNow = Carbon::now()->toDateTimeString();
                $subscriptionDays = '30';
                $normalEnd = DB::raw("DATE_ADD(updated_at, INTERVAL ".$subscriptionDays." DAY)");


                $datetime1 = new DateTime($dateTimeNow);
                $datetime2 = new DateTime($order->created_at);
                $interval = $datetime1->diff($datetime2);
                $suspension_days = $interval->format('%a');




                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '0' ,
                    'ended_at' =>  DB::raw("DATE_ADD(".$normalEnd.", INTERVAL ".$request->pause_period." DAY)"),

                ]);


                //$order->update($data);
                Toastr::success('Your Resturant Order has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.resturants.monthly');

            }



        }else{
            Toastr::error('You entered negative value for pause period!','Error',["positionClass" => "toast-top-right"]);
            return redirect()->route('order.resturants.monthly');
        }
    }
















    // view restaurant order work
    public function resturantsWork()
    {
      $orders=OrderResturant::orderBy('id','desc')->get();
        foreach ($orders as $object) {
            if( $object->resturant['plan_id'] = '3') {
                $orders=OrderResturant::orderBy('id','desc')->get();
                return view('order::resturants.work',compact('orders'));
            }else{
                $orders=OrderResturant::orderBy('id','desc')->get();
                return 'No Results';
                
            }
        }
        
    }
    
    
    // edit restaurant order monthly form

    public function editWork($id)
    {
        $order=OrderResturant::findOrFail($id);
        return view('order::resturants.editWork',compact('order'));
    }


    // update resturant order work form

    public function updateWork(OrderRestaurantsRequest $request, $id)
    {
        $order=OrderResturant::findOrFail($id);
        $data = $request->validated();


        if($request->pause_period == "0"){

            //$created_at = new DateTime($order->created_at);
            $subscriptionDays = '30';
            $dateTimeNow = Carbon::now()->toDateTimeString();
            //$suspension_period_difference = $dateTimeNow - $order->created_at;


            $datetime1 = new DateTime($dateTimeNow);
            $datetime2 = new DateTime($order->created_at);
            $interval = $datetime1->diff($datetime2);
            $suspension_days = $interval->format('%a');




            if(is_null($order->updated_at)){
                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '1' ,
                    'ended_at' =>  DB::raw("DATE_ADD(created_at, INTERVAL ".$subscriptionDays." DAY)"),

                ]);
                Toastr::warning('Your Pause Period Finished and Your Subscription is Active Now!','Warning',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.resturants.work');
            }else{

                $normalEnd = DB::raw("DATE_ADD(created_at, INTERVAL "."$subscriptionDays"." DAY)");


                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '1' ,
                    'ended_at' =>  DB::raw("DATE_ADD(".$normalEnd.", INTERVAL ".$suspension_days." DAY)"),

                ]);


                Toastr::warning('Your Pause Period Finished and Your Subscription is Active Now!','Warning',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.resturants.work');

            }




        }elseif($request->pause_period > "0"){

            if(is_null($order->updated_at)){

                $dateTimeNow = Carbon::now()->toDateTimeString();
                $subscriptionDays = '30';
                $normalEnd = DB::raw("DATE_ADD(created_at, INTERVAL ".$subscriptionDays." DAY)");


                $datetime1 = new DateTime($dateTimeNow);
                $datetime2 = new DateTime($order->created_at);
                $interval = $datetime1->diff($datetime2);
                $suspension_days = $interval->format('%a');




                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '0' ,
                    'ended_at' =>  DB::raw("DATE_ADD(".$normalEnd.", INTERVAL ".$request->pause_period." DAY)"),

                ]);


                //$order->update($data);
                Toastr::success('Your Resturant Order has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.resturants.work');






            }else{
                $dateTimeNow = Carbon::now()->toDateTimeString();
                $subscriptionDays = $order->resturant->plan->period_days;
                $normalEnd = DB::raw("DATE_ADD(updated_at, INTERVAL ".$subscriptionDays." DAY)");


                $datetime1 = new DateTime($dateTimeNow);
                $datetime2 = new DateTime($order->created_at);
                $interval = $datetime1->diff($datetime2);
                $suspension_days = $interval->format('%a');




                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '0' ,
                    'ended_at' =>  DB::raw("DATE_ADD(".$normalEnd.", INTERVAL ".$request->pause_period." DAY)"),

                ]);


                //$order->update($data);
                Toastr::success('Your Resturant Order has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.resturants.work');

            }



        }else{
            Toastr::error('You entered negative value for pause period!','Error',["positionClass" => "toast-top-right"]);
            return redirect()->route('order.resturants.work');
        }
    }














    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function resturantsShow($id)
    {
        $order=OrderResturant::findOrFail($id);
        $orderCarts=OrderResturantCart::where('order_id',$order->id)->get();
        $orderModifiers=OrderModifier::where('order_id',$order->id)->get();
        return view('order::resturants.show',compact('order','orderCarts','orderModifiers'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
     
     
    
    
    
      
    // generate pdf
    function resturantsPdf($id)
    {
        $order=OrderResturant::find($id);
        $orderCarts=OrderResturantCart::where('order_id',$order->id)->get();
        $orderModifiers=OrderModifier::where('order_id',$order->id)->get();
        
        
        
        
        //$dompdf = new Dompdf();
        //$dompdf->loadHtml('hello world');

        $pdf = PDF::loadView('order::resturants.pdf', ['order'=>$order, 'orderCarts'=>$orderCarts, 'orderModifiers'=>$orderModifiers])->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);;
        return $pdf->stream('download.pdf');
        
        //$contacts=ClubContact::find($id);
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->PDF::loadView('clubcontact.pdf', $contacts);
        //return $pdf->downlaod('Contact.pdf');
    }
    
    /* 
    function convert_contact_data_to_html($id)
    {
     $contacts=ClubContact::find($id);

    }
    */
    
  
    
    
    
    public function resturantsUpdateStatus(Request $request)
    {
        $order=OrderResturant::findOrFail($request->id);
        $order->accepted = $request->accepted;
        if($order->save()){
            return 1;
        }
        return 0;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function resturantsDestroy($id)
    {
        $order=OrderResturant::findOrFail($id);
        $order->delete();
        Toastr::success('Your Order has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function clubsIndex()
    {
        $orders=FitnessClubOrder::orderBy('id','desc')->get();
        return view('order::clubs.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function clubsShow($id)
    {
        $order=FitnessClubOrder::findOrFail($id);
        $clubDetails=FitnessClub::where('id',$order->fitness_club_id)->get();
        $subDetails=Subscription::where('id',$order->subscription_id)->get();
        return view('order::clubs.show',compact('order','clubDetails','subDetails'));
    }


    
    // generate pdf
    function clubsPdf($id)
    {
        $order=FitnessClubOrder::find($id);
        $clubDetails=FitnessClub::where('id',$order->fitness_club_id)->get();
        $subDetails=Subscription::where('id',$order->subscription_id)->get();
        
        
        
        //$dompdf = new Dompdf();
        //$dompdf->loadHtml('hello world');

        $pdf = PDF::loadView('order::clubs.pdf', ['order'=>$order, 'clubDetails'=>$clubDetails, 'subDetails'=>$subDetails])->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);;
        return $pdf->stream('download.pdf');
        
        //$contacts=ClubContact::find($id);
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->PDF::loadView('clubcontact.pdf', $contacts);
        //return $pdf->downlaod('Contact.pdf');
    }
    
    /* 
    function convert_contact_data_to_html($id)
    {
     $contacts=ClubContact::find($id);

    }
    */
    
    
    

    /**
     * Show the form for creating a new resource.
     * @return Response
     */





    // edit club order form

    public function edit($id)
    {
        $order=FitnessClubOrder::findOrFail($id);
        return view('order::clubs.edit',compact('order'));
    }



    /*
    public function pause($id) {
        $order = FitnessClubOrder::findOrFail($id);
        $clubDetails = FitnessClub::where('id',$order->fitness_club_id)->get();
        $subDetails = Subscription::where('id',$order->subscription_id)->get();
        return view('order::clubs.pause',compact('order','clubDetails','subDetails'));

    }
    */


    // update club order form

    public function update(OrderClubsRequest $request, $id)
    {
        $order=FitnessClubOrder::findOrFail($id);
        $data = $request->validated();


        if($request->pause_period == "0"){

            //$created_at = new DateTime($order->created_at);
            $subscriptionDays = $order->subscription->period_days;
            $dateTimeNow = Carbon::now()->toDateTimeString();
            //$suspension_period_difference = $dateTimeNow - $order->created_at;


            $datetime1 = new DateTime($dateTimeNow);
            $datetime2 = new DateTime($order->created_at);
            $interval = $datetime1->diff($datetime2);
            $suspension_days = $interval->format('%a');




            if(is_null($order->updated_at)){
                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '1' ,
                    'ended_at' =>  DB::raw("DATE_ADD(created_at, INTERVAL ".$subscriptionDays." DAY)"),

                ]);
                Toastr::warning('Your Pause Period Finished and Your Subscription is Active Now!','Warning',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.clubs.index');
            }else{

                $normalEnd = DB::raw("DATE_ADD(created_at, INTERVAL ".$subscriptionDays." DAY)");


                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '1' ,
                    'ended_at' =>  DB::raw("DATE_ADD(".$normalEnd.", INTERVAL ".$suspension_days." DAY)"),

                ]);


                Toastr::warning('Your Pause Period Finished and Your Subscription is Active Now!','Warning',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.clubs.index');

            }




        }elseif($request->pause_period > "0"){

            if(is_null($order->updated_at)){

                $dateTimeNow = Carbon::now()->toDateTimeString();
                $subscriptionDays = $order->subscription->period_days;
                $normalEnd = DB::raw("DATE_ADD(created_at, INTERVAL ".$subscriptionDays." DAY)");


                $datetime1 = new DateTime($dateTimeNow);
                $datetime2 = new DateTime($order->created_at);
                $interval = $datetime1->diff($datetime2);
                $suspension_days = $interval->format('%a');




                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '0' ,
                    'ended_at' =>  DB::raw("DATE_ADD(".$normalEnd.", INTERVAL ".$request->pause_period." DAY)"),

                ]);


                //$order->update($data);
                Toastr::success('Your Club Order has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.clubs.index');






            }else{
                $dateTimeNow = Carbon::now()->toDateTimeString();
                $subscriptionDays = $order->subscription->period_days;
                $normalEnd = DB::raw("DATE_ADD(updated_at, INTERVAL ".$subscriptionDays." DAY)");


                $datetime1 = new DateTime($dateTimeNow);
                $datetime2 = new DateTime($order->created_at);
                $interval = $datetime1->diff($datetime2);
                $suspension_days = $interval->format('%a');




                $order->update([
                    'updated_at' => $dateTimeNow,
                    'pause_period' => $request->pause_period,
                    'accepted' => '0' ,
                    'ended_at' =>  DB::raw("DATE_ADD(".$normalEnd.", INTERVAL ".$request->pause_period." DAY)"),

                ]);


                //$order->update($data);
                Toastr::success('Your Club Order has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
                return redirect()->route('order.clubs.index');

            }



        }else{
            Toastr::error('You entered negative value for pause period!','Error',["positionClass" => "toast-top-right"]);
            return redirect()->route('order.clubs.index');
        }
    }




    /*

    public function update(Request $request, $id) {
        $request->validate([
           'accepted' => 'required|max:200',

        ]);

        $order = FitnessClubOrder::findOrFail($id);
        $order->accepted = $request->accepted;

        $order->save();

        return redirect('/order/clubs')->with('status','Club order was updated!');

    }
    */




    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function clubsUpdateStatus(Request $request)
    {
        $order=FitnessClubOrder::findOrFail($request->id);
        $order->accepted = $request->accepted;
        if($order->save()){
            return 1;
        }
        return 0;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function clubsDestroy($id)
    {
        $order=FitnessClubOrder::findOrFail($id);
        $order->delete();
        Toastr::success('Your Order has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }



    public function nutritionistsIndex()
    {
        $orders=NutritionistOrder::orderBy('id','desc')->get();
        return view('order::nutritionist.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function nutritionistsShow($id)
    {
        $order=NutritionistOrder::findOrFail($id);
        return view('order::nutritionist.show',compact('order'));
    }
    
    
    
       
    // generate pdf
    function nutritionistsPdf($id)
    {
        $order=NutritionistOrder::find($id);
        
        //$dompdf = new Dompdf();
        //$dompdf->loadHtml('hello world');

        $pdf = PDF::loadView('order::nutritionist.pdf', ['order'=>$order])->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);;
        return $pdf->stream('download.pdf');
        
        //$contacts=ClubContact::find($id);
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->PDF::loadView('clubcontact.pdf', $contacts);
        //return $pdf->downlaod('Contact.pdf');
    }
    
    /* 
    function convert_contact_data_to_html($id)
    {
     $contacts=ClubContact::find($id);

    }
    */
    
    
    
    
    

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function nutritionistsUpdateStatus(Request $request)
    {
        $order=NutritionistOrder::findOrFail($request->id);
        $order->accepted = $request->accepted;
        if($order->save()){
            return 1;
        }
        return 0;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function nutritionistsDestroy($id)
    {
        $order=NutritionistOrder::findOrFail($id);
        $order->delete();
        Toastr::success('Your Order has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }






    public function trainersIndex()
    {
        $orders=TrainerOrder::orderBy('id','desc')->get();
        return view('order::trainers.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function trainersShow($id)
    {
        $order=TrainerOrder::findOrFail($id);
        return view('order::trainers.show',compact('order'));
    }
    
    
    
     
    // generate pdf
    function trainersPdf($id)
    {
        $order=TrainerOrder::find($id);
        
        //$dompdf = new Dompdf();
        //$dompdf->loadHtml('hello world');

        $pdf = PDF::loadView('order::trainers.pdf', ['order'=>$order])->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);;
        return $pdf->stream('download.pdf');
        
        //$contacts=ClubContact::find($id);
        //$pdf = \App::make('dompdf.wrapper');
        //$pdf->PDF::loadView('clubcontact.pdf', $contacts);
        //return $pdf->downlaod('Contact.pdf');
    }
    
    /* 
    function convert_contact_data_to_html($id)
    {
     $contacts=ClubContact::find($id);

    }
    */
    
    

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function TrainersOrderUpdateStatus(Request $request)
    {
        $order=TrainerOrder::findOrFail($request->id);
        $order->accepted = $request->accepted;
        if($order->save()){
            return 1;
        }
        return 0;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function TrainersDestroy($id)
    {
        $order=TrainerOrder::findOrFail($id);
        $order->delete();
        Toastr::success('Your Order has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
