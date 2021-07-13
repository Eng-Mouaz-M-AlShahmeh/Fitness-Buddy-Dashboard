<?php

namespace Modules\Resturant\Http\Controllers\Api;

use App\Models\Day;
use App\Station;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Entities\User;
use Modules\Branch\Entities\Branch;
use Modules\City\Entities\City;
use Modules\DepartmentSlider\Entities\DepartmentSlider;
use Modules\DepartmentSliders\Entities\DepartmentSliders;
use Modules\Meal\Entities\Meal;
use Modules\MealIngredient\Entities\MealIngredient;
use Modules\MealModifier\Entities\MealModifier;
use Modules\Modifier\Entities\Modifier;
use Modules\Resturant\Entities\MealDay;
use Modules\Resturant\Entities\Resturant;
use Modules\Resturant\Entities\ResturantRating;
use Modules\ResturantCategory\Entities\ResturantCategory;
use Modules\ResturantRatings\Entities\ResturantRatings;
use Modules\ResturantSlider\Entities\ResturantSlider;

class ResturantController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function resturants(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('plan_id'=>'required','dept_id'=>'required','type'=>'required','lat'=>'required',
                'lng'=>'required' ));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang=getallheaders()['Lang'];
        if($request->plan_id=='1'){
        $getResturantsSliders=DepartmentSlider::where('status','1')
            ->where('dept_id','1')
            ->take('4')->get();
        $slider_item = [];
        $slider_list = [];
        foreach ($getResturantsSliders as $slider) {
            $slider_item['id'] = $slider->id;
            $slider_item['image'] = $slider->slider;
            $slider_item['title'] = $slider->translate($lang)->title;
            $slider_item['description'] = $slider->translate($lang)->desc;
            $slider_list[] = $slider_item;
        }
        $data['resturants_sliders']=$slider_list;


        $getResturants=Resturant::where('dept_id',$request->dept_id)
            ->where('plan_id','1')
            ->where('type',$request->type)
            ->where('closed','0')
            ->where('status','1')
            ->get();

        $res_item = [];
        $res_list = [];
        foreach ($getResturants as $resturant) {
            $res_item['id'] = $resturant->id;
            $city =City::where('id',$resturant->city_id)->first();
            $getRestCity=$city->translate($lang)->name;
            $res_item['name'] = $resturant->translate($lang)->name." - ".$getRestCity;
            $res_item['icon'] = $resturant->icon;
            $res_item['offer'] = $resturant->translate($lang)->offer;
            $res_item['price_delivery'] = $resturant->price_delivery." ".$resturant->translate($lang)->price." | ".$resturant->min." ".$resturant->translate($lang)->mins;
            $res_item['lat'] = $resturant->lat;
            $res_item['lng'] = $resturant->lng;
            $theta = $request->lng - $resturant->lng;
            $getCount=ResturantRating::where('resturant_id',$resturant->id)->count();
            if (!empty($getCount)) {
                $res_item['reviews'] = $getCount;
            } else {
                $res_item['reviews'] = 0;
            }
            $dist = sin(deg2rad($request->lat)) * sin(deg2rad($resturant->lat)) +  cos(deg2rad($request->lat)) * cos(deg2rad($resturant->lat)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit='K';
            $unit = strtoupper($unit);

            if ($unit == "K")
            {
                // $res_item['distance'] = round(($miles * 1.609344),2);
                $res_item['distance'] =number_format((float)$miles* 1.609344, 2, '.', '')." km for distance";
            }
            else if ($unit == "N")
            {
                // $res_item['distance'] = round(($miles * 0.8684),2);
                $res_item['distance'] =  number_format((float)$miles* 0.8684, 2, '.', '')." km for distance";
            }
            else
            {
                // $res_item['distance'] =  round(($miles),2);
                $res_item['distance'] =  number_format((float)$miles, 2, '.', '')." km for distance";
            }

            if ($resturant->type=="0"){
                $res_item['type'] = "delivery";
            }else{
                $res_item['type'] = "pickup";
            }

            $rateRest = ResturantRating::where('resturant_id',$resturant->id)->select('rating')->avg('rating');
            if (!empty($rateRest)) {
                $res_item['rate'] = $rateRest;
            } else {
                $res_item['rate'] = 0;
            }
            $res_list[] = $res_item;
        }


        $data['resturants_list']=$res_list;


            $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'allresturants',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
        }elseif($request->plan_id=='2'){
            $getResturantsSliders=DepartmentSlider::where('status','1')
                ->where('dept_id','1')
                ->take('4')->get();
            $slider_item = [];
            $slider_list = [];
            foreach ($getResturantsSliders as $slider) {
                $slider_item['id'] = $slider->id;
                $slider_item['image'] = $slider->slider;
                $slider_item['title'] = $slider->translate($lang)->title;
                $slider_item['description'] = $slider->translate($lang)->desc;
                $slider_list[] = $slider_item;
            }
            $data['resturants_sliders']=$slider_list;

            $getResturants=Resturant::where('dept_id',$request->dept_id)
                ->where('plan_id','2')
                ->where('type',$request->type)
                ->where('closed','0')
                ->where('status','1')
                ->get();

            $res_item = [];
            $res_list = [];
            foreach ($getResturants as $resturant) {
                $res_item['id'] = $resturant->id;
                $city =City::where('id',$resturant->city_id)->first();
                $getRestCity=$city->translate($lang)->name;
                $res_item['name'] = $resturant->translate($lang)->name." - ".$getRestCity;
                $res_item['icon'] = $resturant->icon;
                $res_item['offer'] = $resturant->translate($lang)->offer;
                $res_item['price_delivery'] = $resturant->price_delivery." ".$resturant->translate($lang)->price." | ".$resturant->min." ".$resturant->translate($lang)->mins;
                $res_item['lat'] = $resturant->lat;
                $res_item['lng'] = $resturant->lng;
                $theta = $request->lng - $resturant->lng;
                $getCount=ResturantRating::where('resturant_id',$resturant->id)->count();
                if (!empty($getCount)) {
                    $res_item['reviews'] = $getCount;
                } else {
                    $res_item['reviews'] = 0;
                }
                $dist = sin(deg2rad($request->lat)) * sin(deg2rad($resturant->lat)) +  cos(deg2rad($request->lat)) * cos(deg2rad($resturant->lat)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $unit='K';
                $unit = strtoupper($unit);

                if ($unit == "K")
                {
                    // $res_item['distance'] = round(($miles * 1.609344),2);
                    $res_item['distance'] =number_format((float)$miles* 1.609344, 2, '.', '')." km for distance";
                }
                else if ($unit == "N")
                {
                    // $res_item['distance'] = round(($miles * 0.8684),2);
                    $res_item['distance'] =  number_format((float)$miles* 0.8684, 2, '.', '')." km for distance";
                }
                else
                {
                    // $res_item['distance'] =  round(($miles),2);
                    $res_item['distance'] =  number_format((float)$miles, 2, '.', '')." km for distance";
                }

                if ($resturant->type=="0"){
                    $res_item['type'] = "delivery";
                }else{
                    $res_item['type'] = "pickup";
                }

                $rateRest = ResturantRating::where('resturant_id',$resturant->id)->select('rating')->avg('rating');
                if (!empty($rateRest)) {
                    $res_item['rate'] = $rateRest;
                } else {
                    $res_item['rate'] = 0;
                }
                $res_list[] = $res_item;
            }


            $data['resturants_list']=$res_list;

            $response = [
                'code' => 200,
                'status'=>true,
                'message' => 'allresturants',
                'data' => isset($data) ? $data : [],
            ];
            return \Response::json($response, 200);
        }else{
            $getResturantsSliders=DepartmentSlider::where('status','1')
                ->where('dept_id','1')
                ->take('4')->get();
            $slider_item = [];
            $slider_list = [];
            foreach ($getResturantsSliders as $slider) {
                $slider_item['id'] = $slider->id;
                $slider_item['image'] = $slider->slider;
                $slider_item['title'] = $slider->translate($lang)->title;
                $slider_item['description'] = $slider->translate($lang)->desc;
                $slider_list[] = $slider_item;
            }
            $data['resturants_sliders']=$slider_list;



            $getResturants=Resturant::where('plan_id','3')
                ->where('status','1')
                ->where('dept_id',$request->dept_id)
                ->where('type',$request->type)
                ->where('closed','0')
                ->where('status','1')
                ->get();
            $res_item = [];
            $res_list = [];
            foreach ($getResturants as $resturant) {
                $res_item['id'] = $resturant->id;
                $city =City::where('id',$resturant->city_id)->first();
                $getRestCity=$city->translate($lang)->name;
                $res_item['name'] = $resturant->translate($lang)->name." - ".$getRestCity;
                $res_item['icon'] = $resturant->icon;
                $res_item['offer'] = $resturant->translate($lang)->offer;
                $res_item['price_delivery'] = $resturant->price_delivery." ".$resturant->translate($lang)->price." | ".$resturant->min." ".$resturant->translate($lang)->mins;
                $res_item['lat'] = $resturant->lat;
                $res_item['lng'] = $resturant->lng;
                $theta = $request->lng - $resturant->lng;
                $getCount=ResturantRating::where('resturant_id',$resturant->id)->count();
                if (!empty($getCount)) {
                    $res_item['reviews'] = $getCount;
                } else {
                    $res_item['reviews'] = 0;
                }
                $dist = sin(deg2rad($request->lat)) * sin(deg2rad($resturant->lat)) +  cos(deg2rad($request->lat)) * cos(deg2rad($resturant->lat)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $unit='K';
                $unit = strtoupper($unit);

                if ($unit == "K")
                {
                    // $res_item['distance'] = round(($miles * 1.609344),2);
                    $res_item['distance'] =number_format((float)$miles* 1.609344, 2, '.', '')." km for distance";
                }
                else if ($unit == "N")
                {
                    // $res_item['distance'] = round(($miles * 0.8684),2);
                    $res_item['distance'] =  number_format((float)$miles* 0.8684, 2, '.', '')." km for distance";
                }
                else
                {
                    // $res_item['distance'] =  round(($miles),2);
                    $res_item['distance'] =  number_format((float)$miles, 2, '.', '')." km for distance";
                }

                if ($resturant->type=="0"){
                    $res_item['type'] = "delivery";
                }else{
                    $res_item['type'] = "pickup";
                }

                $rateRest = ResturantRating::where('resturant_id',$resturant->id)->select('rating')->avg('rating');
                if (!empty($rateRest)) {
                    $res_item['rate'] = $rateRest;
                } else {
                    $res_item['rate'] = 0;
                }
                $res_list[] = $res_item;
            }


            $data['resturants_list']=$res_list;

    
            $response = [
                'code' => 200,
                'status'=>true,
                'message' => 'allresturants',
                'data' => isset($data) ? $data : [],
            ];
            return \Response::json($response, 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function rateResturant(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('resturant_id'=>'required','rating'=>'required'));
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


            $rating=new ResturantRating();
            $rating->resturant_id=$request->resturant_id;
            $rating->rating = $request->rating;
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
    public function resturantDetails(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('resturant_id'=>'required','category_id'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang=getallheaders()['Lang'];

        $rests=Resturant::where('id', $request->resturant_id)->first();
        if($rests->plan_id=='1'){
            $resturantCats = ResturantCategory::where('resturant_id', $request->resturant_id)
                ->where('status','1')->get();
            $res_cat_item = [];
            $res_cat_list = [];
            foreach ($resturantCats as $resCat) {
                $res_cat_item['id'] = $resCat->id;
                $res_cat_item['name'] = $resCat->translate($lang)->name;
                $res_cat_list[] = $res_cat_item;
            }
            $data['resturant_categories']=$res_cat_list;
        $resturantMeals = Meal::where('resturant_id', $request->resturant_id)
            ->where('cat_id',$request->category_id)
            ->where('status','1')->get();
        $res_meals_item = [];
        $res_meals_list = [];
        foreach ($resturantMeals as $resMeal) {
            $res_meals_item['id'] = $resMeal->id;
            $res_meals_item['name'] = $resMeal->translate($lang)->name;
            $res_meals_item['image'] = $resMeal->image;
            $res_meals_item['kcal'] = $resMeal->calories." ". $resMeal->translate($lang)->calorie;
            $res_meals_item['price_before'] = $resMeal->price_before." ". $resMeal->translate($lang)->currency;
            if($resMeal->price_after=="0")
            {
                $res_meals_item['price_after']="";
            }else{
                $res_meals_item['price_after'] = $resMeal->price_after." ". $resMeal->translate($lang)->currency;
            }
            $res_meals_item['description'] = $resMeal->translate($lang)->desc;
            $res_meals_list[] = $res_meals_item;
        }
        $data['resturant_categories_meals']=$res_meals_list;
        }elseif($rests->plan_id=='2') {
            $resturantCats = ResturantCategory::where('resturant_id', $request->resturant_id)
                ->where('status','1')->get();
            $res_cat_item = [];
            $res_cat_list = [];
            foreach ($resturantCats as $resCat) {
                $res_cat_item['id'] = $resCat->id;
                $res_cat_item['name'] = $resCat->translate($lang)->name;
                $res_cat_list[] = $res_cat_item;
            }
            $data['resturant_categories']=$res_cat_list;

            $days=Day::all();
             $day_item = [];
            $days_list = [];
            foreach ($days as $day) {
                $day_item['id'] = $day->id;
                $day_item['name'] = $day->translate($lang)->name;
                $days_list[] = $day_item;
            }
            $data['days']=$days_list;




            $resturantMonthMeals = Meal::where('resturant_id', $request->resturant_id)
                ->where('cat_id', $request->category_id)
                ->where('meal_day_id',$request->meal_day_id)
                ->where('day_id',$request->day_id)
                ->where('status', '1')->get();
            $res_month_meals_item = [];
            $res_month_meals_list = [];
            foreach ($resturantMonthMeals as $monthRes) {
                $res_month_meals_item['id'] = $monthRes->id;
                $day =Day::where('id',$monthRes->day_id)->first();
                $getday=$day->translate($lang)->name;
                $res_month_meals_item['name'] = $monthRes->translate($lang)->name;
                $res_month_meals_item['image'] = $monthRes->image;
                $res_month_meals_item['kcal'] = $monthRes->calories . " " . $monthRes->translate($lang)->calorie;
                $res_month_meals_item['description'] = $monthRes->translate($lang)->desc;
                $res_month_meals_list[] = $res_month_meals_item;
            }
            $data['resturant_categories_meals'] = $res_month_meals_list;
        }else{
            $resturantCats = ResturantCategory::where('resturant_id', $request->resturant_id)
                ->where('status','1')->get();
            $res_cat_item = [];
            $res_cat_list = [];
            foreach ($resturantCats as $resCat) {
                $res_cat_item['id'] = $resCat->id;
                $res_cat_item['name'] = $resCat->translate($lang)->name;
                $res_cat_list[] = $res_cat_item;
            }
            $data['resturant_categories']=$res_cat_list;
            $resturantWorkLunchMeals = Meal::where('resturant_id', $request->resturant_id)
                ->where('cat_id', $request->category_id)
                ->where('status', '1')->get();
            $res_worklunch_meals_item = [];
            $res_worklunch_meals_list = [];
            foreach ($resturantWorkLunchMeals as $worklunch) {
                $res_worklunch_meals_item['id'] = $worklunch->id;
                $res_worklunch_meals_item['name'] = $worklunch->translate($lang)->name;
                $res_worklunch_meals_item['image'] = $worklunch->image;
                $res_worklunch_meals_item['kcal'] = $worklunch->calories . " " . $worklunch->translate($lang)->calorie;
                $res_worklunch_meals_item['description'] = $worklunch->translate($lang)->desc;
                 $res_meals_item['price'] = $worklunch->price_before." ". $worklunch->translate($lang)->currency;
                $res_worklunch_meals_list[] = $res_worklunch_meals_item;
            }
            $data['resturant_categories_meals'] = $res_worklunch_meals_list;
        }



        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'resturant_details',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function mealDetails(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('meal_id'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang=getallheaders()['Lang'];
        $getMealDetails=Meal::where('id',$request->meal_id)->get();
        $res_item = [];
        $res_list = [];
        foreach ($getMealDetails as $meal) {
            $res_item['id'] = $meal->id;
            $res_item['name'] = $meal->translate($lang)->name;
            $res_item['image'] = $meal->image;
            $res_item['description'] = $meal->translate($lang)->desc;
            $getMealIngredients=MealIngredient::where('meal_id',$request->meal_id)->get();
            $allingredients = array();
            $i = 0;
            foreach ($getMealIngredients as $ingredient) {

                $allingredients[$i] = array(
                    'id'=>$ingredient->id,
                    'ingredient'=> $ingredient->translate($lang)->ingredient,
                    'quantity' => $ingredient->calorie." ". $ingredient->translate($lang)->calories,
                );
                $i++;
            }
            $res_item['meal_ingredients'] = $allingredients;
            $getMealModifiers=MealModifier::where('meal_id',$request->meal_id)->pluck('modifier_id');
            $modifiers=Modifier::whereIn('id',$getMealModifiers)->get();
            $allmodifiers = array();
            $i = 0;
            foreach ($modifiers as $modifier) {

                $allmodifiers[$i] = array(
                    'id'=>$modifier->id,
                    'modifier'=> $modifier->translate($lang)->modifier,
                );
                $i++;
            }
            $res_item['meal_modifiers'] = $allmodifiers;
            $res_list = $res_item;
        }

        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'meal_details',
            'data' => isset($res_list) ? $res_list : [],
        ];
        return \Response::json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function searchResturant(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('name'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }

        $getResturants=Resturant::where('name', 'LIKE', '%' . $request->name . '%')
            ->where('status','1')
            ->get();
        $res_item = [];
        $res_list = [];
        foreach ($getResturants as $resturant) {
            $res_item['id'] = $resturant->id;
            $getRestCity=City::where('id',$resturant->city_id)->select('name')->first();
            $res_item['name'] = $resturant->name." - ".$getRestCity->name;
            $res_item['icon'] = $resturant->icon;
            $res_item['offer'] = $resturant->offer;
            $res_item['price_delivery'] = $resturant->price_delivery;
            $res_item['mins'] = $resturant->mins;
            if ($resturant->type=="0"){
                $res_item['type'] = "delivery";
            }else{
                $res_item['type'] = "pickup";
            }
            if ($resturant->closed=="1")
            {
                $res_item['closed'] = "closed";
            }else{
                $res_item['closed'] = "0";
            }
            $rateRest = ResturantRating::where('resturant_id',$resturant->id)->select('rating')->avg('rating');
            if (!empty($rateRest)) {
                $res_item['rate'] = $rateRest;
            } else {
                $res_item['rate'] = 0;
            }
            $res_list[] = $res_item;
        }

        $data['resturants']=$res_list;


        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'resturants_results',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function searchMeals(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('resturant_id'=>'required','category_id'=>'required','name'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }

        $resturantMeals = Meal::where('name', 'LIKE', '%' . $request->name . '%')
            ->where('resturant_id', $request->resturant_id)
            ->where('cat_id',$request->category_id)
            ->where('status','1')->get();
        $res_meals_item = [];
        $res_meals_list = [];
        foreach ($resturantMeals as $resMeal) {
            $res_meals_item['id'] = $resMeal->id;
            $res_meals_item['name'] = $resMeal->name;
            $res_meals_item['image'] = $resMeal->image;
            $res_meals_item['kcal'] = $resMeal->calories;
            $res_meals_item['price_before'] = $resMeal->price_before;
            $res_meals_item['price_after'] = $resMeal->price_after;
            $res_meals_item['description'] = $resMeal->desc;
            $res_meals_list[] = $res_meals_item;
        }
        $data['meals']=$res_meals_list;




        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'meals_results',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function resturantCategories(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('resturant_id'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang=getallheaders()['Lang'];

        $getResturantDetails=Resturant::where('id',$request->resturant_id)->get();
        $res_item = [];
        $res_list = [];
        foreach ($getResturantDetails as $resturant) {
            $res_item['id'] = $resturant->id;
            $city =City::where('id',$resturant->city_id)->first();
            $getRestCity=$city->translate($lang)->name;
            $res_item['name'] = $resturant->translate($lang)->name." - ".$getRestCity;
            $res_item['image'] = $resturant->image;
            $res_item['offer'] = $resturant->translate($lang)->offer;
            $res_item['price_delivery'] = $resturant->price_delivery." ".$resturant->translate($lang)->price." | ".$resturant->min." ".$resturant->translate($lang)->mins;
            if ($resturant->type=="0"){
                $res_item['type'] = "delivery";
            }else{
                $res_item['type'] = "pickup";
            }
            $rateRest = ResturantRating::where('resturant_id',$resturant->id)->select('rating')->avg('rating');
            if (!empty($rateRest)) {
                $res_item['rate'] = $rateRest;
            } else {
                $res_item['rate'] = 0;
            }
            $getCount=ResturantRating::where('resturant_id',$resturant->id)->count();
            if (!empty($getCount)) {
                $res_item['reviews'] = $getCount;
            } else {
                $res_item['reviews'] = 0;
            }
            $res_list = $res_item;
        }
        $data['resturant_details']=$res_list;

        $resturantCats = ResturantCategory::where('resturant_id', $request->resturant_id)
            ->where('status','1')->get();
        $res_cat_item = [];
        $res_cat_list = [];
        foreach ($resturantCats as $resCat) {
            $res_cat_item['id'] = $resCat->id;
            $res_cat_item['name'] = $resCat->translate($lang)->name;
            $res_cat_list[] = $res_cat_item;
        }
        $data['resturant_categories']=$res_cat_list;
        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'resturant_categories',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }

    public function filterResturants(Request $request)
    {
        $lang = getallheaders()['Lang'];
        $request->lang = $lang;
        $validator = Validator::make($request->all(),
            array('price_from'=>'required','price_to'=>'required','lat'=>'required','lng'=>'required',
                'rating'=>'required',
                ));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $getResturants=Resturant::where('price_delivery',$request->price_from)->orWhere('price_delivery', $request->price_to)
            ->get();
        $res_item = [];
        $res_list = [];
        foreach ($getResturants as $resturant) {
            $res_item['id'] = $resturant->id;
            $city =City::where('id',$resturant->city_id)->first();
            $getRestCity=$city->translate($lang)->name;
            $res_item['name'] = $resturant->translate($lang)->name." - ".$getRestCity;
            $res_item['icon'] = $resturant->icon;
            $res_item['offer'] = $resturant->translate($lang)->offer;
            $res_item['price_delivery'] = $resturant->price_delivery." ".$resturant->translate($lang)->price." | ".$resturant->min." ".$resturant->translate($lang)->mins;
            $res_item['lat'] = $resturant->lat;
            $res_item['lng'] = $resturant->lng;
            $theta = $request->lng - $resturant->lng;
            $getCount=ResturantRating::where('resturant_id',$resturant->id)->count();
            if (!empty($getCount)) {
                $res_item['reviews'] = $getCount;
            } else {
                $res_item['reviews'] = 0;
            }
            $dist = sin(deg2rad($request->lat)) * sin(deg2rad($resturant->lat)) +  cos(deg2rad($request->lat)) * cos(deg2rad($resturant->lat)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit='K';
            $unit = strtoupper($unit);

            if ($unit == "K")
            {
                // $res_item['distance'] = round(($miles * 1.609344),2);
                $res_item['distance'] =number_format((float)$miles* 1.609344, 2, '.', '')." km for distance";
            }
            else if ($unit == "N")
            {
                // $res_item['distance'] = round(($miles * 0.8684),2);
                $res_item['distance'] =  number_format((float)$miles* 0.8684, 2, '.', '')." km for distance";
            }
            else
            {
                // $res_item['distance'] =  round(($miles),2);
                $res_item['distance'] =  number_format((float)$miles, 2, '.', '')." km for distance";
            }

            if ($resturant->type=="0"){
                $res_item['type'] = "delivery";
            }else{
                $res_item['type'] = "pickup";
            }

            $rateRest = ResturantRating::where('rating',$request->rating)->select('rating')->avg('rating');
            if (!empty($rateRest)) {
                $res_item['rate'] = $rateRest;
            } else {
                $res_item['rate'] = 0;
            }
            $res_list[] = $res_item;
        }


        $data['resturants_list']=$res_list;


        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'allresturants',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }

    public function getGetMealsDay(Request $request)
    {
        $lang = getallheaders()['Lang'];
      $getMealsPerDay=MealDay::get();
        $res_item = [];
        $res_list = [];
        foreach ($getMealsPerDay as $meal) {
            $res_item['id'] = $meal->id;
            $res_item['name'] = $meal->translate($lang)->name;
            $res_item['price']=$meal->translate($lang)->currency." ".$meal->price;
               $res_item['number']=$meal->number;
            $res_list[] = $res_item;
        }
        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'meals_per_day',
            'data' => isset($res_list) ? $res_list : [],
        ];
        return \Response::json($response, 200);
    }
}
