<?php

namespace Modules\Trainer\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\City\Entities\City;
use Modules\DepartmentSlider\Entities\DepartmentSlider;
use Modules\Nutritionist\Entities\Classes;
use Modules\Nutritionist\Entities\Language;
use Modules\Nutritionist\Entities\Nationality;
use Modules\Trainer\Entities\Trainer;
use Modules\Trainer\Entities\TrainerClass;
use Modules\Trainer\Entities\TrainerLanguage;
use Modules\Trainer\Entities\TrainerRate;
use Modules\Trainer\Entities\TrainerSlider;
use Modules\Trainer\Entities\TrainerImage;
use Illuminate\Support\Facades\Validator;

class TrainersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function trainers(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('plan_id'=>'required','dept_id'=>'required','type'=>'required','lat'=>'required',
                'lng'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang=getallheaders()['Lang'];
        $getTrainersSliders=DepartmentSlider::where('status','1')
            ->where('dept_id','4')
            ->take('4')->get();
        $slider_item = [];
        $slider_list = [];
        foreach ($getTrainersSliders as $slider) {
            $slider_item['id'] = $slider->id;
            $slider_item['image'] = $slider->slider;
            $slider_item['title'] = $slider->translate($lang)->title;
            $slider_item['description'] = $slider->translate($lang)->desc;
            $slider_list[] = $slider_item;
        }
        $data['trainer_sliders']=$slider_list;

        $getTrainers=Trainer::where('dept_id',$request->dept_id)->
        where('plan_id',$request->plan_id)->
        where('type',$request->type)->
        where('status','1')->
        where('is_busy','0')
            ->get();
        $res_item = [];
        $res_list = [];
        foreach ($getTrainers as $trainer) {
            $res_item['id'] = $trainer->id;
            $getRestCity=City::where('id',$trainer->city_id)->first();
            $res_item['name'] = $trainer->translate($lang)->name;
            $res_item['city']=$getRestCity->translate($lang)->name;
            $res_item['image'] = $trainer->image;
            $res_item['price'] = $trainer->price." ".$trainer->translate($lang)->currency;
            $countClasses=TrainerClass::where('trainer_id',$trainer->id)->count();
            $res_item['classes_count']=$trainer->translate($lang)->class;

            $rateRest = TrainerRate::where('trainer_id',$trainer->id)->select('rate')->avg('rate');
            if (!empty($rateRest)) {
                $res_item['rate'] = $rateRest;
            } else {
                $res_item['rate'] = 0;
            }
            $theta = $request->lng - $trainer->lng;
            $dist = sin(deg2rad($request->lat)) * sin(deg2rad($trainer->lat)) +  cos(deg2rad($request->lat)) * cos(deg2rad($trainer->lat)) * cos(deg2rad($theta));
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

            $res_list[] = $res_item;
        }


        $data['trainers_list']=$res_list;

        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'alltrainers',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function trainerDetails(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('trainer_id'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang=getallheaders()['Lang'];
        $getTrainerDetails=Trainer::where('id',$request->trainer_id)->get();
        $res_item = [];
        $res_list = [];
        foreach ($getTrainerDetails as $trainer) {
            $res_item['id'] = $trainer->id;
            $getRestCity=City::where('id',$trainer->city_id)->first();
            $res_item['city'] =  $getRestCity->translate($lang)->name;
            $res_item['name'] = $trainer->translate($lang)->name;
            $res_item['image'] = $trainer->image;
            $res_item['about'] = $trainer->translate($lang)->about;
            $res_item['age'] = $trainer->age;
            $res_item['level'] = $trainer->translate($lang)->level;
            $res_item['available_time'] = $trainer->available_time;
            $nationality=Nationality::where('id',$trainer->nationality_id)->first();
            $res_item['nationality'] = $nationality->translate($lang)->name;

            $getclasses=TrainerClass::where('trainer_id',$trainer->id)->pluck('class_id');
            $class=Classes::where('id',$getclasses)->first();
            $res_item['class_time'] = $class->time;

            $getlang=TrainerLanguage::where('trainer_id',$trainer->id)->pluck('language_id');
            $languages=Language::whereIn('id',$getlang)->get();
            $alllanguages = array();
            $i = 0;
            foreach ($languages as $language) {
                $alllanguages[$i] = array(
                    'id'=>$language->id,
                    'language'=> $language->translate($lang)->name,
                );
                $i++;
            }
            $res_item['languages'] = $alllanguages;
            $res_list = $res_item;
        }
        $data=$res_list;

        $trainerImages = TrainerImage::where('trainer_id', $request->trainer_id)
            ->where('status','1')->get();
        $res_image_item = [];
        $res_image_list = [];
        foreach ($trainerImages as $image) {
            $res_image_item['id'] = $image->id;
            $res_image_item['name'] = $image->translate($lang)->name;
            $res_image_item['image'] = $image->image;
            $res_image_list[] = $res_image_item;
        }
        $data['trainer_Images']=$res_image_list;

        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'trainer_details',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function searchTrainers(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('name'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }

        $getTrainers=Trainer::where('name', 'LIKE', '%' . $request->name . '%')
            ->where('status','1')
            ->where('is_busy','0')
            ->get();
        $res_item = [];
        $res_list = [];
        foreach ($getTrainers as $trainer) {
            $res_item['id'] = $trainer->id;
            $getRestCity=City::where('id',$trainer->city_id)->select('name')->first();
            $res_item['name'] = $trainer->name;
            $res_item['city']=$getRestCity->name;
            $res_item['image'] = $trainer->image;
            $res_item['price'] = $trainer->price;
            $countClasses=TrainerClass::where('trainer_id',$trainer->id)->count();
            $res_item['classes_count']=$countClasses;

            $rateRest = round(TrainerRate::where('trainer_id',$trainer->id)->select('rate')->avg('rate'));
            if (!empty($rateRest)) {
                $res_item['rate'] = (string)$rateRest;
            } else {
                $res_item['rate'] = "0";
            }
            $res_list[] = $res_item;
        }

        $data['trainers']=$res_list;


        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'trainers_results',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('trainer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('trainer::edit');
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
