<?php

namespace Modules\NutritionistContact\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Entities\User;
use Modules\NutritionistContact\Entities\NutritionistContact;

class NutritionistContactController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function insertContactForm(Request $request)
    {
        $validator = Validator::make($request->all(),
            array('nutri_id','subject'=>'required','msg'=>'required'));
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->messages()->all()]);
        }
        $Jwt = getallheaders()['Jwt'];
        $result=User::where('jwt',$Jwt)->first();
        if (!isset($result)) {
            return response()->json([
                'status' => false,
                'message' => 'user not found',
                'data' => [],
                'errors' => [],
            ], 404);
        }
        $request['user_id'] = $result->id;
        NutritionistContact::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'suggestion sent',
            'data' => [],
            'errors' => [],
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('nutritionistcontact::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('nutritionistcontact::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('nutritionistcontact::edit');
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
