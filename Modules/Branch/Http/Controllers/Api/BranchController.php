<?php

namespace Modules\Branch\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Branch\Entities\Branch;
use Modules\Resturant\Entities\Resturant;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function branches()
    {
        $lang=getallheaders()['Lang'];
        $branches = Branch::where('status',1)->get();
        $res_item = [];
        $res_list = [];
        foreach ($branches as $branch) {
            $res_item['id'] = $branch->id;
            $res_item['name'] = $branch->translate($lang)->name;
            $res_item['lat'] = $branch->lat;
            $res_item['lng'] = $branch->lng;
            $res_item['rest_id'] = $branch->rest_id;
            $rest =Resturant::where('id',$branch->rest_id)->first();
            $name=$rest->translate($lang)->name;
            $res_item['rest_name'] = $name;
            $res_list[] = $res_item;
        }
        $data=$res_list;



        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'allbranches',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('branch::create');
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
        return view('branch::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('branch::edit');
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
