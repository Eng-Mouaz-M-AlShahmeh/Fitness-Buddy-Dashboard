<?php

namespace Modules\City\Http\Controllers;

use Modules\City\Http\Requests\CityRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\City\Entities\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $cities=City::orderBy('created_at')->get();
        return view('city::index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('city::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CityRequest $request)
    {
        $data = $request->validated();

        $cities = City::create($data);

        if($cities->save()) {
            Toastr::success('Your City has been Added successfully!', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->route('city.index');
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
        return view('city::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $city= City::findOrFail($id);
        return view('city::edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CityRequest $request,$id)
    {
        $city=City::findOrFail($id);
        $data = $request->validated();
        $city->update($data);
        Toastr::success('Your City has been Updated successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->route('city.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        Toastr::success('Your City has been Deleted successfully!','Success',["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function updateStatus(Request $request)
    {
        $city = City::findOrFail($request->id);
        $city->status = $request->status;
        if($city->save()){
            return 1;
        }
        return 0;
    }
}
