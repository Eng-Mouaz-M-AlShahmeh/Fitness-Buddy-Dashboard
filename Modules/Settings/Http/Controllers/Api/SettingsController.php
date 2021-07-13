<?php

namespace Modules\Settings\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\Settings;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getPrivacy(){
        $lang=getallheaders()['Lang'];
        $settings = Settings::find(1);
        $data= array('privacy' => $settings->translate($lang)->privacy);
        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'privacy',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function getAbout(){
        $lang=getallheaders()['Lang'];
        $settings = Settings::find(1);
        $data= array('about' => $settings->translate($lang)->about);
        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'about',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
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
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('settings::edit');
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
