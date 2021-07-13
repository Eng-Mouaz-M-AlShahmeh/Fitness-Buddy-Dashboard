<?php

namespace Modules\Day\Http\Controllers;

use App\Models\Day;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Day\Http\Requests\DayRequest;
use Modules\ResturantCategory\Entities\ResturantCategory;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $days=Day::orderBy('created_at')->get();
        return view('day::index',compact('days'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $cats=ResturantCategory::all();
        return view('day::create',compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(DayRequest $request)
    {
        $data = $request->validated();
        if(isset($request->cat_id)){
            $data['cat_id']=$request->cat_id;
        }
        $day = Day::create($data);

        if($day->save()) {
            Toastr::success('Your Day has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('day.index');
        }else{
            Toastr::success('Sorry! Something went wrong.', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('day::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $cats=ResturantCategory::all();
        $day= Day::findOrFail($id);
        return view('day::edit',compact('day','cats'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(DayRequest $request, $id)
    {
        $day= Day::findOrFail($id);
        $data = $request->validated();
        if(isset($request->cat_id)){
            $day->cat_id=$request->cat_id;
        }
        $day->update($data);
        Toastr::success('Your Day has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('day.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $day= Day::findOrFail($id);
        $day->delete();
        Toastr::success('Your Day has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $day = Day::findOrFail($request->id);
        $day->status = $request->status;
        if($day->save()){
            return 1;
        }
        return 0;
    }
    
    
    public function getDaysApi(Request $request){
        $lang=getallheaders()['Lang'];
        $days = Day::where('status',1)->get();
        $res_item = [];
        $res_list = [];
        foreach ($days as $day) {
            $res_item['id'] = $day->id;
            $res_item['name'] = $day->translate($lang)->name;

            $res_list[] = $res_item;
        }
        $data=$res_list;

        $response = [
            'code' => 200,
            'status'=>true,
            'message' => 'alldays',
            'data' => isset($data) ? $data : [],
        ];
        return \Response::json($response, 200);
    }
}
