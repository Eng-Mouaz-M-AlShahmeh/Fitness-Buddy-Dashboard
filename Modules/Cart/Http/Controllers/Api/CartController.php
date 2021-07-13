<?php

namespace Modules\Cart\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Entities\User;
use Modules\Cart\Entities\Cart;
use Modules\FitnessClub\Entities\FitnessClub;
use Modules\Meal\Entities\Meal;
use Modules\Nutritionist\Entities\Nutritionist;
use Modules\Resturant\Entities\Resturant;
use Modules\Trainer\Entities\Trainer;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function addCart(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array('meal_id' => 'required', 'quantity' => 'required')
        );
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $Jwt = getallheaders()['Jwt'];
        $result = User::where('jwt', $Jwt)->first();
        if ($result == 'false') {
            return response()->json([
                'status' => false,
                'message' => 'user not found',
                'data' => [],
                'errors' => [],
            ], 404);
        }
        $cart = Cart::where(array('user_id' => $result->id, 'meal_id' => $request->meal_id))->first();
        if ($cart) {
            $cart->delete();
            return response()->json([
                'status' => false,
                'message' => 'meal not found',
                'data' => [],
                'errors' => [],
            ], 404);
        }
        $return = Cart::create(
            array(
                'user_id' => $result->id,
                'meal_id' => $request->meal_id,
                'quantity' => $request->quantity
            )
        );
        if ($return == "false") {
            return response()->json([
                'status' => false,
                'message' => 'meal deleted',
                'data' => [],
                'errors' => [],
            ], 401);
        }
        //return response()->json(res_msg($lang, success(), 200, 'fave_done'));
        return response()->json([
            'status' => true,
            'message' => 'Successfully added to cart',
            'data' => [],
            'errors' => [],
        ], 201);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function getCartList(Request $request)
    {
        $lang = getallheaders()['Lang'];
        $theta = $request->lng - $request->lng;
        $lat = $request->lat;
        $lng = $request->lng;

        $Jwt = getallheaders()['Jwt'];
        $result = User::where('jwt', $Jwt)->first();
        if ($result == 'false') {
            return response()->json([
                'status' => false,
                'message' => 'user not found',
                'data' => [],
                'errors' => [],
            ], 404);
        }
        $cartList = Cart::where('user_id', $result->id)->get();
        $res_item = [];
        $res_list = [];
        foreach ($cartList as $cart) {
            $meals = Meal::whereHas('resturant', function ($query) use ($lat, $lng) {
                $query->selectRaw("id,lat,lng,( 6371000 * acos( cos( radians(?) ) *
                cos( radians( lat ) )
                * cos( radians( lng ) - radians(?)
                ) + sin( radians(?) ) *
                sin( radians( lat ) ) )
              ) AS distance", [$lat, $lng, $lat])
                    ->having('distance', '<=', 25)->orderBy('distance');
            })->where('id', $cart->meal_id)->get();
            foreach ($meals as $meal) {
                $res_item["id"] = $cart->id;
                $res_item['quantity'] = $cart->quantity;
                $res_item['meal_name'] = $meal->translate($lang)->name;
                $res_item['calories'] = $meal->translate($lang)->calorie . " " . $meal->calories;
                $res_item['price'] = $meal->price_before . " " . $meal->translate($lang)->currency;
                if ($meal->price_after == "0") {
                    $res_item['price_after'] = "";
                } else {
                    $res_item['price_after'] = $meal->price_after . " " . $meal->translate($lang)->currency;
                }
                $res_list[] = $res_item;
            }

        }
        $data = $res_list;

        $response = [
            'code' => 200,
            'status' => true,
            'message' => 'allcartlist',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function terms(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('dept_id'=>'required','specialist_id'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $lang=getallheaders()['Lang'];
        if($request->dept_id=='1'){
            $restTerms=Resturant::where('id',$request->specialist_id)->get();
            $rest_item = [];
            $rest_list = [];
            foreach ($restTerms as $terms) {
                $rest_item['id'] = $terms->id;
                $rest_item['terms'] = $terms->translate($lang)->terms;
                $rest_list[] = $rest_item;
            }
            $data['rest_terms']=$rest_list;
            $response = [
                'code' => 200,
                'status'=>true,
                'message' => 'restterms',
                'data' => isset($data) ? $data : [],
            ];
            return \Response::json($response, 200);
        }elseif($request->dept_id=='2'){
            $clubTerms=FitnessClub::where('id',$request->specialist_id)->get();
            $club_item = [];
            $club_list = [];
            foreach ($clubTerms as $club) {
                $club_item['id'] = $club->id;
                $club_item['terms'] = $club->translate($lang)->terms;
                $club_list[] = $club_item;
            }
            $data['club_terms']=$club_item;
            $response = [
                'code' => 200,
                'status'=>true,
                'message' => 'clubterms',
                'data' => isset($data) ? $data : [],
            ];
            return \Response::json($response, 200);
        }
        elseif($request->dept_id=='3'){
            $nutriTerms=Nutritionist::where('id',$request->specialist_id)->get();
            $nutri_item = [];
            $nutri_list = [];
            foreach ($nutriTerms as $nutri) {
                $nutri_item['id'] = $nutri->id;
                $nutri_item['terms'] = $nutri->translate($lang)->terms;
                $nutri_list[] = $nutri_item;
            }
            $data['nutri_terms']=$nutri_item;
            $response = [
                'code' => 200,
                'status'=>true,
                'message' => 'nutritionistterms',
                'data' => isset($data) ? $data : [],
            ];
            return \Response::json($response, 200);
        }else{
            $trainerTerms=Trainer::where('id',$request->specialist_id)->get();
            $trainer_item = [];
            $trainer_list = [];
            foreach ($trainerTerms as $trainer) {
                $trainer_item['id'] = $trainer->id;
                $trainer_item['terms'] = $trainer->translate($lang)->terms;
                $trainer_list[] = $trainer_item;
            }
            $data['trainer_terms']=$trainer_item;
            $response = [
                'code' => 200,
                'status'=>true,
                'message' => 'trainerterms',
                'data' => isset($data) ? $data : [],
            ];
            return \Response::json($response, 200);
    }

}

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('cart::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cart::edit');
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
