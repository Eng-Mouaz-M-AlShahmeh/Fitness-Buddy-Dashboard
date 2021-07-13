<?php

namespace Modules\FitnessClub\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Entities\User;
use Modules\City\Entities\City;
use Modules\DepartmentSlider\Entities\DepartmentSlider;
use Modules\FitnessClub\Entities\ClubActivity;
use Modules\FitnessClub\Entities\ClubSlider;
use Modules\FitnessClub\Entities\ClubSubscription;
use Modules\FitnessClub\Entities\FitnessClub;
use Modules\FitnessClub\Entities\FitnessClubRating;
use Modules\Meal\Entities\Meal;
use Modules\Resturant\Entities\Resturant;
use Modules\Resturant\Entities\ResturantRating;
use Modules\ResturantCategory\Entities\ResturantCategory;
use Modules\Subscription\Entities\Subscription;

class FitnessClubController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function clubs(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('lat'=>'required','lng'=>'required','type'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang = getallheaders()['Lang'];
        $getClubsSliders=DepartmentSlider::where('status','1')
            ->where('dept_id','2')
            ->take('4')->get();
        $slider_item = [];
        $slider_list = [];
        foreach ($getClubsSliders as $slider) {
            $slider_item['id'] = $slider->id;
            $slider_item['image'] = $slider->slider;
            $slider_item['title'] = $slider->translate($lang)->title;
            $slider_item['description'] = $slider->translate($lang)->desc;
            $slider_list[] = $slider_item;
        }
        $data['fitness_club_sliders']=$slider_list;

        $getClubs=FitnessClub::where('status','1')
            ->where('type',$request->type)
            ->get();
        $res_item = [];
        $res_list = [];
        foreach ($getClubs as $club) {
            $res_item['id'] = $club->id;
            $city =City::where('id',$club->city_id)->first();
            $getRestCity=$city->translate($lang)->name;
            $res_item['name'] = $club->translate($lang)->name." - ".$getRestCity;
            $res_item['logo'] = $club->logo;
            $res_item['image'] = $club->image;
            $res_item['desc'] = $club->translate($lang)->desc;
            $res_item['type'] = $club->type;
            $theta = $request->lng - $club->lng;
            $dist = sin(deg2rad($request->lat)) * sin(deg2rad($club->lat)) +  cos(deg2rad($request->lat)) * cos(deg2rad($club->lat)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit='K';
            $unit = strtoupper($unit);

            if ($unit == "K")
            {

                $res_item['distance'] = number_format((float)$miles * 1.609344, 2, '.', '')." km for distance";
            }
            else if ($unit == "N")
            {

                $res_item['distance'] = number_format((float)$miles * 0.8684, 2, '.', '')." km for distance";
            }
            else
            {

                $res_item['distance'] = number_format((float)$miles, 2, '.', '')." km for distance";
            }

            $rateRest = round(FitnessClubRating::where('club_id',$club->id)->select('rate')->avg('rate'));
            if (!empty($rateRest)) {
                $res_item['rate'] = $rateRest;
            } else {
                $res_item['rate'] = 0;
            }

            $res_list[] = $res_item;
        }

        $data['clubs_list']=$res_list;

        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'allclubs',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function rateClubs(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('club_id'=>'required','rating'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $Jwt = getallheaders()['Jwt'];
        $user=User::where('Jwt',$Jwt)->first();
        if (!isset($user)) {
            $response = [
                'code' => 403,
                'status' => false,
                'message' => 'user not login',
                'data' => [],
            ];
            return \Response::json($response, 200);
        }else{


            $rating=new FitnessClubRating();
            $rating->club_id=$request->club_id;
            $rating->rate = $request->rating;
            $rating->review = $request->review;
            $rating->user_id=$user->id;
            $rating->save();

            $response = [
                'code' => 200,
                'status' => true,
                'message' => 'rating sent',
                'data' => [],
            ];
            return \Response::json($response, 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function clubDetails(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('club_id'=>'required','lat'=>'required','lng'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang = getallheaders()['Lang'];



        $getClubDetails=FitnessClub::where('id',$request->club_id)->get();
        $res_item = [];
        $res_list = [];
        foreach ($getClubDetails as $club) {
            $res_item['id'] = $club->id;
            $city =City::where('id',$club->city_id)->first();
            $getRestCity=$city->translate($lang)->name;
            $res_item['name'] = $club->translate($lang)->name." - ".$getRestCity;
            $res_item['desc']= $club->translate($lang)->desc;
            $theta = $request->lng - $club->lng;
            $dist = sin(deg2rad($request->lat)) * sin(deg2rad($club->lat)) +  cos(deg2rad($request->lat)) * cos(deg2rad($club->lat)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit='K';
            $unit = strtoupper($unit);

            if ($unit == "K")
            {

                $res_item['distance'] =  number_format((float)$miles * 1.609344, 2, '.', '')." km for distance";
            }
            else if ($unit == "N")
            {

                $res_item['distance'] = number_format((float)$miles * 0.8684, 2, '.', '')." km for distance";
            }
            else
            {

                $res_item['distance'] = number_format((float)$miles, 2, '.', '')." km for distance";

            }


            $getClubsSliders=ClubSlider::where('club_id',$request->club_id)
                ->where('main_slider','0')
                ->where('status','1')
                ->get();
            $slider_item = [];
            $slider_list = [];
            foreach ($getClubsSliders as $slider) {
                $slider_item['id'] = $request->club_id;
                $slider_item['image'] = $slider->image;
                $slider_list[] = $slider_item;
            }
            $res_item['fitness_club_sliders']=$slider_list;

            $getClubsActivities=ClubActivity::where('club_id',$request->club_id)->select('id','icon')->take(4)->get();
            $res_item['fitness_club_activities']=$getClubsActivities;

            $countActivities=ClubActivity::where('club_id',$request->club_id)->count();
            $res_item['fitness_club_activities_count']=$countActivities;

            $getClubSub=ClubSubscription::where('club_id',$club->id)->pluck('subscription_id');
            $subs=Subscription::whereIn('id',$getClubSub)->get();

            $allsubs = array();
            $i = 0;
            foreach ($subs as $sub) {

                $allsubs[$i] = array(
                    'id'=>$sub->id,
                    'name'=> $sub->translate($lang)->name,
                    'price'=>$sub->price." ".$sub->translate($lang)->currency
                );
                $i++;
            }
            $res_item['club_subscriptions'] = $allsubs;

            $getClubRatings=FitnessClubRating::where('club_id',$club->id)->get();
            $rate_item = [];
            $rate_list = [];
            foreach ($getClubRatings as $rate) {
                $rate_item['id'] = $rate->id;
                $rate_item['rate'] = $rate->rate;
                $rate_item['review'] = $rate->review;
                $rate_item['created_at'] = $rate->created_at;
                $getuser=User::where('id',$rate->user_id)->select('id','name','image')->first();
                $rate_item['user_id'] = $getuser->id;
                $rate_item['user_name'] = $getuser->name;
                $rate_item['user_image'] = $getuser->image;
                $rate_list[] = $rate_item;
            }
            $res_item['club_ratings']=$rate_list;




            $res_list = $res_item;
        }
        $data=$res_list;


        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'club_details',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function searchClub(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('name'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }

        $clubs=FitnessClub::where('name', 'LIKE', '%' . $request->name . '%')
            ->where('status','1')
            ->get();
        $res_item = [];
        $res_list = [];
        foreach ($clubs as $club) {
            $res_item['id'] = $club->id;
            $getRestCity=City::where('id',$club->city_id)->select('name')->first();
            $res_item['name'] = $club->name." - ".$getRestCity->name;
            $res_item['logo'] = $club->logo;
            $res_item['image'] = $club->image;
            $res_item['desc'] = $club->desc;
            $res_item['type'] = $club->type;
            $theta = $request->lng - $club->lng;
            $dist = sin(deg2rad($request->lat)) * sin(deg2rad($club->lat)) +  cos(deg2rad($request->lat)) * cos(deg2rad($club->lat)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit='K';
            $unit = strtoupper($unit);

            if ($unit == "K")
            {
                $res_item['distance'] = round(($miles * 1.609344),2);
            }
            else if ($unit == "N")
            {
                $res_item['distance'] = round(($miles * 0.8684),2);
            }
            else
            {
                $res_item['distance'] =  round(($miles),2);
            }

            $rateRest = round(FitnessClubRating::where('club_id',$club->id)->select('rate')->avg('rate'));
            if (!empty($rateRest)) {
                $res_item['rate'] = (string)$rateRest;
            } else {
                $res_item['rate'] = "0";
            }

            $res_list[] = $res_item;
        }

        $data['clubs']=$res_list;


        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'clubs_results',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('fitnessclub::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
